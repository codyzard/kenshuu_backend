<div class="profile">
    <div class="main-profile">
        <label for="<?php echo $_SESSION['user']['id'] === $profile['id'] ? 'profile-change' : '' ?>" class="profile__avatar <?php echo $_SESSION['user']['id'] === $profile['id'] ? 'change-avatar' : '' ?>">
            <img src="/public/assets/image/authors/<?php Helper::print_filtered($profile['avatar'] && file_exists($_SERVER['DOCUMENT_ROOT'] . "/public/assets/image/authors/" . $profile['avatar']) ? $profile['avatar'] : "../default-avatar.png") ?>" alt="">
            <input name="update_avatar" type="file" class="form-control" id="profile-change" hidden> <!-- will use for change avatar by Ajax-->
            <p class="tooltip">アバターを変更する？</p>
        </label>
        <p class="profile__name"><?php Helper::print_filtered($profile['fullname']) ?></p>
        <p class="profile__contribution">
            <span class="profile__contribution__title">記事の数</span>
            <span class="profile__contribution__number"><?php Helper::print_filtered($profile['COUNT(articles.id)']) ?></span>
        </p>
    </div>
    <div class="sub-profile">
        <p class="profile__address">住所: <span><?php Helper::print_filtered($profile['address'] ?: "N/A") ?></span></p>
        <p class="profile__birthday">住所: <span><?php Helper::print_filtered($profile['birthday'] ?: "N/A") ?></span></p>
        <p class="profile__phone">電話番号: <span><?php Helper::print_filtered($profile['phone'] ?: "N/A") ?></span></p>
    </div>
</div>