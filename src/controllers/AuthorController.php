<?php

class AuthorController extends BaseController
{
    private $authorModel;

    public function __construct()
    {
        $this->loadModel('AuthorModel');
        $this->authorModel = new AuthorModel;
    }

    /**
     * Showing author's profile
     *
     * @param  mixed $id
     * @return view
     */
    public function profile($id)
    {
        if (isset($id)) {
            $profile = $this->authorModel->get_profile($id);
            if (!$profile['fullname']) {
                $_SESSION['errors']['profile'] = "プロフィールが取得できません！";
                header('Location: /');
            } else {
                return $this->view("authors.profile", [
                    "profile" => $profile,
                ]);
            }
        }
    }

    /**
     * Updating author's profile avatar
     *
     * @return $src_update || false
     */
    public function update_avatar()
    {
        if (Helper::is_logged($_POST['author_id'])) {
            $author_id = $_POST['author_id'];
            $avatar = $_FILES;
            $src_updated =  $this->authorModel->update_avatar($author_id, $avatar['file']);
            if ($src_updated) {
                echo $src_updated; // return new_avatar_src
            }
            echo false;
        }
    }

    /**
     * Showing update author's profile form
     *
     * @return void
     */
    public function update_profile($id)
    {
        if (Helper::is_logged($id)) {
            Helper::create_csrf_token();
            $author = $this->authorModel->get_profile_for_update($id);
            $author['id'] = $id;
            return $this->view("authors.change_profile", [
                'author' => $author,
            ]);
        } else {
            $_SESSION['errors']['authentication-authorize'] = 'この行動が禁止です！';
            Header('Location: /');
        }
    }

    /**
     * Storing new author's profile after updating
     *
     * @param  int $id
     * @return void
     */
    public function store_update_profile($id)
    {
        if (Helper::is_logged($id)) {
            if (isset($_SESSION['user']) && isset($_POST['fullname'])) {
                $flag = true;
                $email = $_SESSION['user']['email'];
                $fullname = trim($_POST['fullname']);
                $address = trim($_POST['address']);
                $birthday = $_POST['birthday'];
                $phone = trim($_POST['phone']);
                $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
                $phone_to_check = str_replace("-", "", $filtered_phone_number);
                if (empty($fullname) || empty($address) || empty($phone)) {
                    $_SESSION['errors']['fullname'] = 'フルネーム住所や電話番号などを空白にさせないでください！';
                    $flag = false;
                }
                if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 12) {
                    $_SESSION['errors']['phone_length'] = '電話番号は最低10文字、最大12文字としてください！';
                    $flag = false;
                }
                //check flag
                if ($flag) {
                    $is_success = $this->authorModel->update_profile($email, $fullname, $address, $birthday, $phone_to_check);
                    if (!$is_success) {
                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                    } else {
                        $_SESSION['messages']['profile']  = 'プロフィールを変更するのは成功でした！';
                        header('Location: /author/profile/' . $id);
                    }
                } else {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            } else {
                $_SESSION['errors']['system'] = '500 Internal Error';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        } else {
            $_SESSION['errors']['authentication-authorize'] = 'この行動が禁止です！';
            Header('Location: /');
        }
    }

    /**
     * Create new author with validate
     *
     * @return bool
     */
    public function create()
    {
        $flag = true; // for validate
        if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['name']) && isset($_POST['password'])) {
            $email = trim($_POST['email']); // check regex server side
            $username = trim($_POST['username']);
            $fullname = trim($_POST['name']);
            $password = $_POST['password'];
            $avatar = $_FILES['profile-avatar'];
            if (empty($email) || empty($username) || empty($fullname) || empty($password)) {
                $_SESSION['errors']['blank'] = "E-メールやユーザーネームやフルネームやパスワードを空白にさせないでください！";
                $flag = false;
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['errors']['email'] = 'Eメールは妥当ではありませんでした！';
                $flag = false;
            }
            if (strlen($username) < 6) {
                $_SESSION['errors']['username_length'] = 'ユーザーネームは最低6文字、最大100文字としてください！';
                $flag = false;
            }
            if (strlen($password) < 6) {
                $_SESSION['errors']['password_length'] = 'パスワードは最低6文字、最大60文字としてください！';
                $flag = false;
            }
            if ($flag) {
                $new_session = $this->authorModel->create($email, $username, $fullname, $avatar, $password);
                Helper::store_user_data_in_session($new_session);
            } else {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        } else {
            $_SESSION['errors']['system'] = '500 Internal Error';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}
