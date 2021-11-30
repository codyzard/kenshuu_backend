<?php

class AuthorController extends BaseController
{

    public function __construct()
    {
        $this->loadModel('AuthorModel');
        $this->authorModel = new AuthorModel;
    }

    /**
     * Show author's profile
     *
     * @param  mixed $id
     * @return view
     */
    public function profile($id)
    {
        if (isset($id)) {
            $profile = $this->authorModel->get_profile($id);
            if (!$profile) {
                $_SESSION['errors']['profile'] = "プロフィールが取得できません！";
                header('Location: /');
            } else {
                return $this->view("auth.profile", [
                    "profile" => $profile,
                ]);
            }
        }
    }

    /**
     * update author's profile avatar
     *
     * @return $src_update || false
     */
    public function update_avatar()
    {
        if ($_SESSION['user']['id'] == $_POST['author_id']) {
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
     * Create new author with validate
     *
     * @return bool
     */
    public function create()
    {
        $flag = true; // for validate
        if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['password'])) {
            $email = trim($_POST['email']); // check regex server side
            $fullname = trim($_POST['name']);
            $password = $_POST['password'];
            $avatar = $_FILES['profile-avatar'];
            if (empty($email) || empty($fullname) || empty($password)) {
                $_SESSION['errors']['blank'] = "E-メールやフルネームやパスワードを空白にさせないでください！";
                $flag = false;
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['errors']['email'] = 'Eメールは妥当ではありませんでした！';
                $flag = false;
            }
            if (strlen($password) < 6) {
                $_SESSION['errors']['password_length'] = 'パスワードは最低6文字、最大60文字としてください！';
                $flag = false;
            }
            if ($flag) {
                $new_session = $this->authorModel->create($email, $fullname, $avatar, $password);
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
