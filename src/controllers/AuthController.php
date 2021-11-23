<?php

class AuthController extends BaseController
{
    private $authorModel;

    public function __construct()
    {
        $this->loadModel('AuthorModel');
        $this->authorModel = new AuthorModel;
    }

    public function login()
    {
        if (isset($_SESSION['user'])) {
            header('Location: /');
        }
        return $this->view('auth.login');
    }

    public function register()
    {
        if (isset($_SESSION['user'])) {
            header('Location: /');
        }
        return $this->view('auth.register');
    }

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
                if (!$new_session) {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                } else {
                    if (empty(session_id())) {
                        session_start();
                    }
                    $_SESSION['user']['email'] = $new_session['email'];
                    $_SESSION['user']['fullname'] = $new_session['fullname'];
                    header('Location: /');
                }
            } else {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        } else {
            $_SESSION['errors']['system'] = '500 Internal Error';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}
