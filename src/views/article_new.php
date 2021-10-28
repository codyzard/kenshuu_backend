<?php
require '../config/db.php';
$query = $conn->query('SELECT * FROM categories');
$categories = $query->fetchAll();
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
    <link rel="stylesheet" href="../public/assets/sass/article/article_new.css" />
    <script src="./../public/assets//js/jquery.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <title>PR TIMES｜プレスリリース・ニュースリリースNo.1配信サービス</title>
</head>

<body>
    <div class="wrapper">
        <?php include '../views/common/_header.php' ?>
        <div class="post-article">
            <h1 class="post-article__heading">投稿</h1>
            <form class="form" action="./../controllers/article/create.php" method="POST" enctype="multipart/form-data" >
                <div class="form-group">
                    <label for="">タイトル</label>
                    <textarea name="title" id="title" cols="50" rows="3" placeholder="タイトルをつけて。。。" required></textarea>
                </div>
                <div class="form-group">
                    <label for="">サムネイル</label>
                    <input type="file" accept="image/png, image/jpeg" name="thumbnail" id="thumbnail">
                </div>
                <div class="form-group">
                    <label for="">コンテンツ</label>
                    <textarea name="content" id="content" cols="50" rows="10" placeholder="何か書いて。。。" required></textarea>
                </div>
                <div class="form-group">
                    <label for="">カテゴライズ</label>
                    <select name="categories[]" id="categories" multiple required >
                    <option value="" disabled>Select your option</option>
                        <?php foreach ($categories as $c) : ?>
                            <option value="<?php echo $c['id'] ?>"><?php echo $c['category_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <?php include '../views/common/_footer.php' ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script language='javascript'>
        $('#categories').select2({
            placeholder: "カテゴライズを1以上選んで。。。"
        });
    </script>
</body>

</html>