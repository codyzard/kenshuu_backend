<?php
require '../../config/db.php';
if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['categories'])) {
    $title = $_POST['title'];
    $thumbnail = $_FILES['thumbnail'];
    $content = $_POST['content'];
    $categories_id = $_POST['categories'];
    $author_id = 1;

    $query = "INSERT INTO articles (title, thumbnail_id, content, author_id, created_at, updated_at) 
            VALUES (:title, null, :content, :author_id, now(), now())";
    $exec_query = $conn->prepare($query);
    $exec_query->bindValue(':title', $title);
    $exec_query->bindValue(':content', $content);
    $exec_query->bindValue(':author_id', $author_id);
    $exec_query->execute();
    $created_article_id = $conn->lastInsertId();
    //Create thumbnail if param exists and save thumbnail id into article
    if (!empty($thumbnail)) {
        //save file in public
        $info = pathinfo($_FILES['thumbnail']['name']);
        $ext = $info['extension']; // get the extension of the file
        $newname = uniqid() . '.' . $ext;
        $target = '../../public/assets/image/articles/'.$newname;
        if (!is_dir('../../public/assets/image/articles')) {
            mkdir('../../public/assets/image/articles');
        }
        move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target);

        //save thumbnail src in database;
        $thumbnail_query = "INSERT INTO images (src, article_id, created_at, updated_at)
                            VALUES (:src, :article_id, now(), now())";
        $query = $conn->prepare($thumbnail_query);
        $query->bindValue(":src", $newname);
        $query->bindValue(":article_id", $created_article_id);
        $query->execute();
        $created_thumbnail_id = $conn->lastInsertId();


        //create relationship with article
        $update_artcile = $conn->prepare("UPDATE articles SET thumbnail_id = :thumbnail_id 
                                          WHERE id = :article_id");
        $update_artcile->bindValue(':thumbnail_id', $created_thumbnail_id, PDO::PARAM_INT);
        $update_artcile->bindValue(':article_id', $created_article_id, PDO::PARAM_INT);
        $update_artcile->execute();
    }

    //Add categories for article
    foreach ($categories_id as $c_id) {
        $query = $conn->prepare("INSERT INTO articles_categories (article_id, category_id, created_at, updated_at)
                                VALUES (:article_id, :category_id, now(), now())");
        $query->bindValue(':article_id', $created_article_id);
        $query->bindValue(':category_id', $c_id);
        $query->execute();
    }
    echo 'Article created successfully ! <br/>';
    echo "<a href='" . $_SERVER['HTTP_REFERER'] . "'>Go back</a>";
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
