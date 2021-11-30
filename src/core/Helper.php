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

    public static function store_image($file, $error, $size, $location)
    {
        try {
            // 未定義である・複数ファイルである・$_FILES Corruption 攻撃を受けた
            // どれかに該当していれば不正なパラメータとして処理する
            if (!isset($error) || !is_int($error)) {
                throw new RuntimeException('パラメータが不正です');
            }

            // $_FILES['upfile']['error']   
            switch ($error) {
                case UPLOAD_ERR_OK: // OK
                    break;
                case UPLOAD_ERR_NO_FILE:   // ファイル未選択
                    throw new RuntimeException('ファイルが選択されていません');
                case UPLOAD_ERR_INI_SIZE:  // php.ini定義の最大サイズ超過
                case UPLOAD_ERR_FORM_SIZE: // フォーム定義の最大サイズ超過 (設定した場合のみ)
                    throw new RuntimeException('ファイルサイズが大きすぎます');
                default:
                    throw new RuntimeException('その他のエラーが発生しました');
            }

            // ここで定義するサイズ上限のオーバーチェック
            // (必要がある場合のみ)
            if ($size > 2000000) {  //file maxsize 2x10^6 byte ~ 2mb;
                throw new RuntimeException('ファイルサイズが大きすぎます');
            }
            //mime_content_type:  return file extension
            //～すごいコード～
            if (!$ext = array_search(
                mime_content_type($file),
                array(
                    'gif' => 'image/gif',
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                ),
                true // strict_parameter. Explain:  absolutely compare, ex: 3 !== "3", 3===3
            )) {
                throw new RuntimeException('ファイル形式が不正です');
            }
            // ファイルデータからSHA-1ハッシュを取ってファイル名を決定し，保存する
            if (!move_uploaded_file(
                $file,
                $path = sprintf(
                    $location . '%s.%s',
                    $filename = sha1_file($file), //hash & get filename for return and save database
                    $ext
                )
            )) {
                throw new RuntimeException('ファイル保存時にエラーが発生しました');
            }

            // ファイルのパーミッションを確実に0644に設定する
            chmod($path, 0644);

            //get filename with extension
            $filename .= '.' . $ext;

            return $filename;
        } catch (RuntimeException $e) {

            echo $e->getMessage();
        }
    }

    public static function remove_image_from_storage($filesName = [], $pathImage)
    {
        try {
            foreach ($filesName as $fn) {
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathImage . $fn)) { //check file exist before remove
                    unlink($_SERVER['DOCUMENT_ROOT'] . $pathImage . $fn);
                }
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
        return true;
    }

    /**
     * store author's data in session
     *
     * @param  mixed $new_session
     * @return void
     */
    public static function store_user_data_in_session($new_session)
    {
        if (!$new_session) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            if (empty(session_id())) {
                session_start();
            }
            $_SESSION['user']['id'] = $new_session['id'];
            $_SESSION['user']['email'] = $new_session['email'];
            $_SESSION['user']['username'] = $new_session['username'];
            $_SESSION['user']['fullname'] = $new_session['fullname'];
            header('Location: /');
        }
    }
}
