<div class="post-article">
    <h1 class="post-article__heading">変更</h1>
    <?php if (!empty($_SESSION['errors'])) : ?>
        <div class="flash flash--danger">
            <?php foreach ($_SESSION['errors'] as $err) : ?>
                <p class="message"><?php Helper::print_filtered($err) ?></p>
            <?php endforeach ?>
            <?php unset($_SESSION['errors']) ?>
        </div>
    <?php endif ?>
    <form class="form" action="/?controller=article&action=update&id=<?php Helper::print_filtered($id) ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?>">
        </div>
        <div class="form-group">
            <label for="">タイトル</label>
            <textarea name="title" id="title" cols="50" rows="3" placeholder="タイトルをつけて。。。" required><?php Helper::print_filtered($article['title']) ?></textarea>
        </div>
        <div class="form-group">
            <label for="">コンテンツ</label>
            <textarea name="content" id="content" cols="50" rows="10" placeholder="何か書いて。。。" required><?php Helper::print_filtered($article['content']) ?></textarea>
        </div>
        <button type="submit" class="btn btn--warning btn--large">変更</button>
    </form>
</div>
