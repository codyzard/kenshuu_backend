<div class="wrap-article">
    <?php if (!empty($_SESSION['messages'])) : ?>
        <div class="flash flash--success">
            <?php foreach ($_SESSION['messages'] as $mess) : ?>
                <p class="message"><?php Helper::print_filtered($mess) ?></p>
            <?php endforeach ?>
            <?php unset($_SESSION['messages']) ?>
        </div>
    <?php endif ?>
    <div class="article">
        <div class="article-header">
            <h3 class="article__title"><?php print(htmlspecialchars($article['title'], ENT_QUOTES)) ?></h3>
            <div class="sub-info">
                <time class="article__time"><?php Helper::print_filtered($article['created_at']) ?></time>
                <p class="article__author">筆者: <?php Helper::print_filtered($article['fullname']) ?></p>
                <p class="article__view">ページビュー: <?php Helper::print_filtered($article['page_view']) ?></p>
            </div>
        </div>
        <div class="article-main">
            <?php if (!empty($images)) : ?>
                <?php foreach ($images as $img) : ?>
                    <div class="article__image"><img src="/public/assets/image/articles/<?php Helper::print_filtered($img['src']) ?>" alt="article-image"></div>
                <?php endforeach ?>
            <?php endif ?>
            <p class="article__content"><?php Helper::print_filtered($article['content']) ?></p>
        </div>
    </div>
    <div class="control">
        <a class="btn btn--warning btn--radius" href="/article/edit/<?php Helper::print_filtered($id) ?>">変更</a>
        <a class="btn btn--danger btn--radius" onclick="return confirm('Are you sure?')" href="/article/delete/<?php Helper::print_filtered($id) ?>">削除</a>
    </div>
</div>