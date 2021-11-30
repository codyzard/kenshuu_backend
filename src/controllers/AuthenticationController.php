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
     * Show login interface
     *
     * @return view
     */
    public function login()
    {
        Helper::create_csrf_token();
        if (isset($_SESSION['user'])) {
            header('Location: /');
        }
        return $this->view('auth.login');
    }

    /**
     * Show register interface
     *
     * @return view
     */
    public function register()
    {
        Helper::create_csrf_token();
        if (isset($_SESSION['user'])) {
            header('Location: /');
        }
        return $this->view('auth.register');
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
     * Create new session for author
     *
     * @return bool
     */
    public function new_session()
    {
        $flag = true; // for validate
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            if (empty($email) || empty($password)) {
                $_SESSION['errors']['blank'] = "E-メールやパスワードを空白にさせないでください！";
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
                $new_session = $this->authorModel->find_user($email, $password); // return array or false
                Helper::store_user_data_in_session($new_session);
            } else {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
    }

}
