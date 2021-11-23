<div class="session">
    <div class="login">
        <h3>ユーザーログイン</h3>
        <form action="login_process.php" method="POST">
            <div class="form-group">
                <input type="email" name="email" id="email" class="form-control" placeholder="メールアドレス" required />
                <i class="far fa-envelope fa-lg"></i>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" class="form-control" placeholder="パスワード" required />
                <i class="fas fa-lock fa-lg"></i>
                <span class="show-hide-pw">表示</span>
            </div>
            <a href="#" class="forgotten_password">パスワードをお忘れの方</a>
            <input type="submit" value="ログイン" class="btn btn-submit" />
            <div class="form-group">
                <input type="checkbox" name="save_session" /><label></i>次回から自動的にログイン</label>
            </div>
            <a href="/auth/register"><input type="button" value="お申し込み" class="btn btn-res" /></a>
        </form>
        <p class="description">
            アカウントをお持ちでない方で、PR
            TIMESでプレスリリース配信・掲載を希望される方は、”お申し込み”ボタンから企業登録申請を行ってください。
        </p>
    </div>
</div>