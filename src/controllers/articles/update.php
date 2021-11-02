<?php
require '../../config/db.php';
session_start();
if (isset($_REQUEST['id']) && isset($_POST['title']) && isset($_POST['content'])) {
    $id = $_REQUEST['id'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    if (empty($title) || empty($content)) {
        $_SESSION['errors']['blank'] = 'タイトル又はコンテンツが空自にすることはできません！';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
        try {
            $query = $conn->prepare('UPDATE articles SET title = :title, content = :content where id = :id');
            $query->bindValue(':title', $title);
            $query->bindValue(':content', $content);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();

            $_SESSION['messages']['update_success'] = '変更が成功でした！';
            header('Location: /views/article_show.php?id='.$id);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getCode();
        }
    }
}
