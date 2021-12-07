<?php

class AuthenticationController extends BaseController
{
    private $authorModel;

    public function __construct()
    {
        $this->loadModel('AuthorModel');
        $this->authorModel = new AuthorModel;
    }

    /**
     * Showing login interface
     *
     * @return view
     */
    public function login()
    {
        Helper::create_csrf_token();
        if (isset($_SESSION['user'])) {
            header('Location: /');
        }
        return $this->view('authentication.login');
    }

    /**
     * Showing register interface
     *
     * @return view
     */
    public function register()
    {
        Helper::create_csrf_token();
        if (isset($_SESSION['user'])) {
            header('Location: /');
        }
        return $this->view('authentication.register');
    }

    /**
     * Logout & destroy author's session
     *
     * @return view
     */
    public function logout()
    {
        if (!empty(session_id()) && isset($_SESSION['user'])) {
            session_regenerate_id(); // renew session id
            session_destroy(); // clear user's data in session
        }
        header('Location: /');
    }

    /**
     * Creating new session for author
     *
     * @return bool
     */
    public function new_session()
    {
        $flag = true; // for validate
        if (isset($_POST['email_or_username']) && isset($_POST['password'])) {
            $email_or_username = trim($_POST['email_or_username']);
            $password = $_POST['password'];
            if (empty($email_or_username) || empty($password)) {
                $_SESSION['errors']['blank'] = "E-メールやパスワードを空白にさせないでください！";
                $flag = false;
            }
            if (strlen($email_or_username) < 6) {
                $_SESSION['errors']['email_or_username'] = 'メールアドレス又はユーザーネームは最低6文字、最大100文字としてください！';
                $flag = false;
            }
            if (strlen($password) < 6) {
                $_SESSION['errors']['password_length'] = 'パスワードは最低6文字、最大60文字としてください！';
                $flag = false;
            }
            if ($flag) {
                $new_session = $this->authorModel->find_user($email_or_username, $password); // return array or false
                Helper::store_user_data_in_session($new_session);
            } else {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
    }

    /**
     * Showing change password form
     *
     * @param  int $id
     * @return view
     */
    public function change_password($id)
    {
        if (Helper::is_logged($id)) {
            Helper::create_csrf_token();
            return $this->view("authentication.change_password", [
                'author_id' => $id,
            ]);
        } else {
            $_SESSION['errors']['authentication-authorize'] = 'この行動が禁止です！';
            Header('Location: /');
        }
    }

    /**
     * Updating new author's password
     *
     * @param  mixed $id
     * @return void
     */
    public function store_change_password($id)
    {
        if (Helper::is_logged($id)) {
            if (isset($_SESSION['user']) && isset($_POST['old_password']) && isset($_POST['new_password'])) {
                $flag = true;
                $email = $_SESSION['user']['email'];
                $old_password = md5($_POST['old_password']);
                $new_password = md5($_POST['new_password']);
                // check password length must be greater than 6 character
                if (strlen($old_password) < 6 || strlen($new_password) < 6) {
                    $_SESSION['errors']['password'] = 'パスワードは最低6文字、最大60文字としてください！';
                    $flag = false;
                }
                //check flag
                if ($flag) {
                    $is_success = $this->authorModel->update_password($email, $old_password, $new_password);
                    if (!$is_success) {
                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                    } else {
                        $_SESSION['messages']['password']  = 'パスワードを変更するのは成功でした！';
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
}
