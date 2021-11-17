<?php

class ArticleController extends BaseController
{
    private $articleModel;
    private $categoryModel;

    public function __construct()
    {
        $this->loadModel('ArticleModel');
        $this->loadModel('CategoryModel');
        $this->articleModel = new ArticleModel;
        $this->categoryModel = new CategoryModel;
    }

    public function show($id)
    {
        if (isset($id)) {
            $article = $this->articleModel->find_by_id_join_table($id);
            return $this->view("articles.show", [
                'article' => $article,
                'id' => $id,
            ]);
        }
    }

    public function new()
    {
        $categories = $this->categoryModel->get_all();
        Helper::create_csrf_token();
        return $this->view('articles.new', [
            'categories' => $categories,
        ]);
    }

    public function create($article)
    {
        if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['categories'])) {
            if (Helper::csrf_token_validate()) {
                $title = trim($_POST['title']);
                $thumbnail = $_FILES['thumbnail'];
                $content = trim($_POST['content']);
                $categories_id = $_POST['categories'];
                $author_id = 1;
                if (empty($title) || empty($content)) {
                    $_SESSION['errors']['blank'] = 'タイトル又はコンテンツが空自にすることはできません！';
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                } else {
                    $is_success = $this->articleModel->create_article($title, $thumbnail, $content, $categories_id, $author_id);
                    if ($is_success) {
                        echo "<p>記事投稿が成功でした！</p>";
                        echo "<a href='" . $_SERVER['HTTP_REFERER'] . "'>Go back</a><br/>";
                        echo "<a href='/'>Go homepage</a>";
                    } else {
                        $_SESSION['errors']['system'] = '500 Internal Error';
                        header('Location: ' . $_SERVER['HTTP_REFERER']);
                    }
                }
            }
        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    public function edit($id)
    {
        Helper::create_csrf_token();
        if ($id) {
            $article = $this->articleModel->show_edit($id);
            return $this->view("articles.edit", [
                'article' => $article,
                'id' => $id,
            ]);
        }
    }

    public function update($id)
    {
        if (isset($id) && isset($_POST['title']) && isset($_POST['content'])) {
            if (Helper::csrf_token_validate()) {
                $title = trim($_POST['title']);
                $content = trim($_POST['content']);
                if (empty($title) || empty($content)) {
                    $_SESSION['errors']['blank'] = 'タイトル又はコンテンツが空自にすることはできません！';
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                } else {
                    if ($this->articleModel->udpate_article($id, $title, $content)) {
                        $_SESSION['messages']['update_success'] = '変更が成功でした！';
                        header('Location: /article/show/' . $id);
                    };
                }
            }
        }
    }

    public function delete($id)
    {
        if (isset($id)) {
            if ($this->articleModel->delete_article($id)) {
                $_SESSION['messages']['delete_success'] = '削除が成功しました！';
                header('Location: /index.php');
            } else {
                $_SESSION['errors']['system'] = '500 Internal Error';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
    }
}
