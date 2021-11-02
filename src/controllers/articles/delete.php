<?php
require '../../config/db.php';
session_start();
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    try {
        $query = $conn->prepare('DELETE FROM articles WHERE id = :id');
        $query->bindValue(':id', $id);
        $query->execute();

        $_SESSION['messages']['delete_success'] = '削除が制sこうしました！';
        header('Location: /index.php');
        echo $id;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getCode();
    }
}
