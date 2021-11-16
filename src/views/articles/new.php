<div class="post-article">
    <h1 class="post-article__heading">投稿</h1>
    <?php if (!empty($_SESSION['errors'])) : ?>
        <div class="flash flash--danger">
            <?php foreach ($_SESSION['errors'] as $err) : ?>
                <p class="message"><?php Helper::print_filtered($err)  ?></p>
            <?php endforeach ?>
            <?php unset($_SESSION['errors']) ?>
        </div>
    <?php endif ?>
    <form class="form" action="/article/create" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?>">
        </div>
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
            <select name="categories[]" id="categories" multiple required>
                <option value="" disabled>Select your option</option>
                <?php foreach ($categories as $c) : ?>
                    <option value="<?php Helper::print_filtered($c['id']) ?>"><?php Helper::print_filtered($c['category_name']) ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <button type="submit" class="btn btn--primary btn--large">投稿</button>
    </form>
</div>
