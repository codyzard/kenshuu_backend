<div class="session">
    <div class="register">
        <?php if (!empty($_SESSION['errors'])) : ?>
            <div class="flash flash--danger">
                <?php foreach ($_SESSION['errors'] as $err) : ?>
                    <p class="message"><?php Helper::print_filtered($err)  ?></p>
                <?php endforeach ?>
                <?php unset($_SESSION['errors']) ?>
            </div>
        <?php endif ?>
        <h3>ユーザーレジスター</h3>
        <form action="/auth/create" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?>">
            </div>
            <div class="form-group">
                <input type="email" name="email" id="email" class="form-control" placeholder="メールアドレス" value="<?php $_POST['email'] ?: "" ?>" required />
                <i class="far fa-envelope fa-lg"></i>
            </div>
            <div class="form-group">
                <input type="text" name="name" id="name" class="form-control" placeholder="名前" required />
                <i class="fas fa-signature"></i>
            </div>
            <div class="form-group">
                <input type="file" name="profile-avatar" id="profile-avatar" class="form-control" title="Choose profile image" />
                <i class="fas fa-id-card"></i>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" class="form-control hidden-text" placeholder="パスワード" required />
                <i class="fas fa-lock fa-lg"></i>
                <span class="show-hide-pw">表示</span>
            </div>
            <div class="form-group">
                <input type="password" name="cpassword" id="cpassword" class="form-control hidden-text" placeholder="パスワード コンファーム" required />
                <i class="far fa-check-circle"></i>
                <span class="show-hide-pw">表示</span>
            </div>
            <input type="submit" id="submit-register" value="レジスター" class="btn btn-submit" />
        </form>
        <p class="description">
            アカウントをお持ちでない方で、PR TIMESでプレスリリース配信・掲載を希望される方は、”お申し込み”ボタンから企業登録申請を行ってください。
        </p>
    </div>
</div>