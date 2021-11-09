<?php

class Helper
{

    public static function create_csrf_token()
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'] = $token;
        $_SESSION['csrf_token_time'] = time();
    }

    public static function csrf_token_validate()
    {
        if ($_POST['csrf_token'] === $_SESSION['csrf_token']) {
            if ($_SESSION['csrf_token_time'] + 60 * 60 * 24 >= time()) {
                return true;
            } else {
                $_SESSION['errors']['blank'] = 'トークンが満了しました！';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                return false;
            }
        } else {
            $_SESSION['errors']['blank'] = 'トークンが違反しました！';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            return false;
        }
    }

    // avoid DRY, use function flash message 
    public static function flash_message($messages = [])
    {
        $all_msg = "";
        foreach ($messages as $msg) {
            $all_msg .= sprintf("<p class='message'>%s</p>", $msg);
        }
        unset($_SESSION['messages']);
        return $all_msg;
    }

    public static function print_filtered($string)
    {
        print(htmlspecialchars($string, ENT_QUOTES));
    }
}
