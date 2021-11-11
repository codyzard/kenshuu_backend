<?php
require './config/db.php';
class HomeController extends BaseController
{

    private $articleModel;

    public function __construct()
    {
        $this->loadModel('ArticleModel');
        $this->articleModel = new ArticleModel;
    }

    public function index()
    {
        $articles = $this->articleModel->get_all_join_table();
        return $this->view("homes.index", [
            'articles' => $articles,
        ]);
    }
}
