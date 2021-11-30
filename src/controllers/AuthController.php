<?php

class AuthController extends BaseController
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
                $this->store_user_data_in_session($new_session);
            } else {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        } else {
            $_SESSION['errors']['system'] = '500 Internal Error';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
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
                $this->store_user_data_in_session($new_session);
            } else {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
    }

    /**
     * store author's data in session
     *
     * @param  mixed $new_session
     * @return void
     */
    public function store_user_data_in_session($new_session)
    {
        if (!$new_session) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            if (empty(session_id())) {
                session_start();
            }
            $_SESSION['user']['id'] = $new_session['id'];
            $_SESSION['user']['email'] = $new_session['email'];
            $_SESSION['user']['fullname'] = $new_session['fullname'];
            header('Location: /');
        }
    }
}
