<?php
session_start();
require '../config/db.php';
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    try {
        $query = $conn->prepare("SELECT title, content FROM articles WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $article = $query->fetch();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getCode();
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="プレスリリースサイト" />
    <link rel="shortcut icon" type="image/png" href="../public/assets/image/favicon.ico" />
    <link rel="stylesheet" href="../public/assets/sass/main.css" />
    <link rel="stylesheet" href="../public/assets/sass/article/article_new.css? <?php echo time(); ?>" />
    <title>PR TIMES｜プレスリリース・ニュースリリースNo.1配信サービス</title>
</head>

<body>
    <div class="wrapper">
        <?php include '../views/common/_header.php' ?>
        <div class="post-article">
            <h1 class="post-article__heading">変更</h1>
            <?php if (!empty($_SESSION['errors'])) : ?>
                <div class="flash flash--danger">
                    <?php foreach ($_SESSION['errors'] as $err) : ?>
                        <p class="message"><?php echo $err ?></p>
                    <?php endforeach ?>
                    <?php $_SESSION['errors'] = [] ?>
                </div>
            <?php endif ?>
            <form class="form" action="../controllers/articles/update.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">タイトル</label>
                    <textarea name="title" id="title" cols="50" rows="3" placeholder="タイトルをつけて。。。" required><?php echo $article['title'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="">コンテンツ</label>
                    <textarea name="content" id="content" cols="50" rows="10" placeholder="何か書いて。。。" required><?php echo $article['content'] ?></textarea>
                </div>
                <button type="submit" class="btn btn--warning btn--large">変更</button>
            </form>
        </div>
        <?php include '../views/common/_footer.php' ?>
    </div>
</body>

</html>