<?php

class ArticleModel extends BaseModel
{
    //in future use class attribute for model. ex: article->title, article->content, etc...

    const TABLE = 'articles';
    public function get_all_join_table()
    {
        $sql = "SELECT articles.id, title, thumbnail_id, articles.created_at, src, authors.fullname FROM articles
        LEFT JOIN images ON articles.thumbnail_id = images.id 
        INNER JOIN authors ON articles.author_id = authors.id  ORDER BY created_at DESC";
        $result = $this->query($sql);
        return $result->fetchAll();
    }

    public function find_by_id_join_table($id)
    {
        $sql = "SELECT title, content, thumbnail_id, page_view, articles.created_at, src, authors.fullname FROM articles 
                 LEFT JOIN images ON articles.thumbnail_id = images.id 
                 INNER JOIN authors ON articles.author_id = authors.id 
                 WHERE articles.id=:id ";
        $query = $this->prepare_query($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $article = $query->fetch();

        // $pv = intval($article['page_view']) + 1;
        // $query_update = $this->prepare_query("UPDATE articles SET page_view = :pv WHERE id = :id");
        // $query_update->bindValue(':pv', $pv);
        // $query_update->bindValue(':id', $id);
        // $query_update->execute();

        return $article;
    }

    public function show_edit($id)
    {
        $sql = "SELECT title, content FROM articles WHERE id = :id";
        $query = $this->prepare_query($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $article = $query->fetch();
        return $article;
    }

    public function udpate_article($id, $title, $content)
    {
        $query = $this->prepare_query('UPDATE articles SET title = :title, content = :content where id = :id');
        $query->bindValue(':title', $title);
        $query->bindValue(':content', $content);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        return $query->execute();
    }

    public function create_article($title, $thumbnail, $content, $categories_id = [], $author_id)
    {
        try {
            $this->connect->beginTransaction();

            //Create article
            $sql_article = "INSERT INTO articles (title, thumbnail_id, content, author_id, created_at, updated_at) 
                            VALUES (:title, null, :content, :author_id, now(), now())";
            $query_article = $this->prepare_query($sql_article);
            $query_article->bindValue(':title', $title);
            $query_article->bindValue(':content', $content);
            $query_article->bindValue(':author_id', $author_id);
            $result_article = $query_article->execute();
            $created_article_id = $this->connect->lastInsertId();

            //Create thumbnail if param exists and save thumbnail id into article
            if (file_exists($thumbnail['tmp_name'])) {
                //save file in public
                $location  = $_SERVER['DOCUMENT_ROOT'] . '/public/assets/image/articles/'; // 'set location save image'
                $image_name = Helper::store_image($thumbnail, $location); //get name file;
                $path  = $location . $image_name;

                //save thumbnail src in database;
                $sql_image = "INSERT INTO images (src, article_id, created_at, updated_at)
                        VALUES (:src, :article_id, now(), now())";
                $query_image = $this->prepare_query($sql_image);
                $query_image->bindValue(":src", $image_name);
                $query_image->bindValue(":article_id", $created_article_id);
                $result_image = $query_image->execute();
                $created_thumbnail_id = $this->connect->lastInsertId();


                //create relationship with article
                $update_artcile = $this->prepare_query("UPDATE articles SET thumbnail_id = :thumbnail_id WHERE id = :article_id");
                $update_artcile->bindValue(':thumbnail_id', $created_thumbnail_id, PDO::PARAM_INT);
                $update_artcile->bindValue(':article_id', $created_article_id, PDO::PARAM_INT);
                $result_article_image = $update_artcile->execute();
            }

            //Add categories for article
            $result_article_category = [];
            foreach ($categories_id as $c_id) {
                $query = $this->prepare_query("INSERT INTO articles_categories (article_id, category_id, created_at, updated_at)
                            VALUES (:article_id, :category_id, now(), now())");
                $query->bindValue(':article_id', $created_article_id);
                $query->bindValue(':category_id', $c_id);
                $flag[] = $query->execute();
            }
            $result_article_category = (count(array_unique($flag)) === 1 && end(array_unique($flag)) == 1) ? true : false; // check all table articles_categories all value insert success;

            // check query executed successfully?
            if (!$result_article || (isset($result_image) && !$result_image) || (isset($result_article_image) && !$result_article_image) || !$result_article_category) {
                $this->connect->rollBack();
                unlink($path); // delete stored image when failed
                return false;
            } else {
                $this->connect->commit();
                return true;
            }
        } catch (PDOException $e) {
            $this->connect->rollBack();
            unlink($path); // delete stored image when failed
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function delete_article($id)
    {
        //get image src
        $query_get = $this->prepare_query('SELECT src FROM articles INNER JOIN images ON articles.thumbnail_id = images.id WHERE articles.id = :id');
        $query_get->bindValue(':id', $id);
        $query_get->execute();
        $src = $query_get->fetch()[0]; // get src image for delete image from storage

        //delete article
        $query_delete = $this->prepare_query('DELETE FROM articles WHERE id = :id');
        $query_delete->bindValue(':id', $id, PDO::PARAM_INT);
        if ($query_delete->execute()) {
            if (!empty($src)) {
                try {
                    unlink(__DIR__ . '/../public/assets/image/articles/' . $src); //  delete image from storage
                    return true;
                } catch (Exception $e) {
                    echo 'Error: ' . $e->getMessage();
                    return false;
                }
            } else return true;
        } else return false;
    }
}
