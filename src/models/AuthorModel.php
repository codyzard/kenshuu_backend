<?php

class AuthorModel extends BaseModel
{
    const TABLE = 'authors';
    const PUBLIC_IMAGE_AUTHOR_PATH = '/public/assets/image/authors/';

    /**
     * get all authors
     *
     * @return $authors
     */
    public function get_all()
    {
        $sql = 'SELECT * FROM ' . self::TABLE;
        $result = $this->query($sql);

        return $result->fetchAll();
    }

    /**
     * create new author
     *
     * @param  string $email
     * @param  string $fullname
     * @param  string $avatar
     * @param  string $password
     * @return $author || false
     */
    public function create($email, $fullname, $avatar, $password)
    {
        try {
            $this->connect->beginTransaction();

            // check email existed in database ?
            $query_author_from_email = $this->prepare_query("SELECT COUNT(*) FROM authors WHERE email = :email");
            $query_author_from_email->bindValue(':email', $email);
            $query_author_from_email->execute();
            $result_count = $query_author_from_email->fetch();
            if ($result_count[0] > 0) {
                $_SESSION['errors']['email'] = 'このEメールは存在しました！';
                $this->connect->rollBack();
                return false;
            }

            //Create author
            $sql_author = "INSERT INTO authors (email, fullname, password, created_at, updated_at) 
                            VALUES (:email, :fullname, :password, now(), now())";
            $query_author = $this->prepare_query($sql_author);
            $query_author->bindValue(':email', $email);
            $query_author->bindValue(':fullname', $fullname);
            $query_author->bindValue(':password', md5($password));
            $result_author = $query_author->execute();
            $created_author_id = $this->connect->lastInsertId();

            //create avatar
            $result_update_avatar = $this->insert_avatar($created_author_id, $avatar);
            if ($result_update_avatar) {  //$result_update_avatar != false
                $paths = $result_update_avatar[1];
                $result_avatar = $result_update_avatar[2];
            }

            if (!$result_author || (isset($result_avatar) && !$result_avatar)) {
                $this->connect->rollBack();
                Helper::remove_image_from_storage($paths, self::PUBLIC_IMAGE_AUTHOR_PATH); // delete stored image when failed
                return false;
            } else {
                // if register is successful, auto login
                $login_query = $this->prepare_query("SELECT * FROM authors WHERE id = :id ");
                $login_query->bindValue('id', $created_author_id);
                $login_query->execute();
                $new_session = $login_query->fetch();
                $this->connect->commit();

                return $new_session;
            }
        } catch (Exception $e) {
            $this->connect->rollBack();
            Helper::remove_image_from_storage($paths, self::PUBLIC_IMAGE_AUTHOR_PATH); // delete stored image when failed
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    /**
     * find user in database with $email & $password
     *
     * @param  string $email
     * @param  string $password
     * @return $new_session
     */
    public function find_user($email, $password)
    {
        $query_check_email_exist = $this->prepare_query("SELECT COUNT(*) FROM authors WHERE email = :email");
        $query_check_email_exist->bindValue(':email', $email);
        $query_check_email_exist->execute();
        $result_email = $query_check_email_exist->fetch();
        if ($result_email[0] > 0) {
            $query_new_session = $this->prepare_query("SELECT * FROM authors WHERE email = :email AND password = :password");
            $query_new_session->bindValue(":email", $email);
            $query_new_session->bindValue(":password", md5($password));
            $query_new_session->execute();
            $result_new_session = $query_new_session->fetchAll();
            if (count($result_new_session) > 0) {
                return $result_new_session[0];
            }
            $_SESSION['errors']['password'] = 'パスワードは間違いました！';
            return false;
        } else {
            $_SESSION['errors']['email'] = 'このEメールは存在しない！';
            return false;
        }
    }

    /**
     * get author info with $id 
     *
     * @param  mixed $id
     * @return $author_info
     */
    public function get_profile($id)
    {
        $query_profile = $this->prepare_query("SELECT authors.*, COUNT(articles.id) FROM authors LEFT JOIN articles ON articles.author_id = authors.id WHERE authors.id = :id LIMIT 1");
        $query_profile->bindValue(':id', $id, PDO::PARAM_INT);
        $query_profile->execute();
        $result_profile = $query_profile->fetch();
        return $result_profile;
    }

    /**
     * update author's profile avatar
     *
     * @param  mixed $id
     * @param  string $avatar
     * @return $new_src_avatar
     */
    public function update_avatar($id, $avatar)
    {
        try {
            $this->connect->beginTransaction();

            $query_avatar_src = $this->prepare_query("SELECT avatar FROM authors WHERE id = :id");
            $query_avatar_src->bindValue(':id', $id, PDO::PARAM_INT);
            $query_avatar_src->execute();
            $result_avatar_src = $query_avatar_src->fetch();
            $paths_avatar[] = $result_avatar_src[0];

            //remove old avatar if had
            if ($result_avatar_src[0]) {
                Helper::remove_image_from_storage($paths_avatar, self::PUBLIC_IMAGE_AUTHOR_PATH);
            }

            $result_update_avatar = $this->insert_avatar($id, $avatar); //save new avatar into database

            if ($result_update_avatar[2]) {
                $this->connect->commit();
                return ($result_update_avatar[0]); // return src;
            } else {
                $this->connect->rollBack();
                Helper::remove_image_from_storage($result_update_avatar[1], self::PUBLIC_IMAGE_AUTHOR_PATH);
                return false;
            }
        } catch (PDOException $e) {
            Helper::remove_image_from_storage($result_update_avatar[1], self::PUBLIC_IMAGE_AUTHOR_PATH);
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    /**
     * store image in storage and save src in database
     *
     * @param  mixed $id
     * @param  object $avatar
     * @return array
     */
    public function insert_avatar($id, $avatar)
    {
        if (file_exists($avatar['tmp_name'])) {
            // save image into storage
            $location  = $_SERVER['DOCUMENT_ROOT'] . self::PUBLIC_IMAGE_AUTHOR_PATH; // 'set location save image'
            $image_name = Helper::store_image($avatar['tmp_name'], $avatar['error'], $avatar['size'], $location); //get name file;
            $paths[]  = $image_name;

            // save image into database
            $update_author = $this->prepare_query("UPDATE authors SET avatar = :avatar WHERE id = :author_id");
            $update_author->bindValue(':avatar', $image_name);
            $update_author->bindValue(':author_id', $id, PDO::PARAM_INT);
            $result_avatar = $update_author->execute();

            return [$image_name, $paths, $result_avatar]; // 0: include image_name, 1: array image_name, 2: result_sql(true or false)
        }
        return false;
    }
}
