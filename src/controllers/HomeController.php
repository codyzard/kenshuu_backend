<?php
require './config/db.php';
class HomeController extends BaseController
{

    private $articleModel, $categoryModel;

    public function __construct()
    {
        $this->loadModel('ArticleModel');
        $this->loadModel('CategoryModel');
        $this->articleModel = new ArticleModel;
        $this->categoryModel = new CategoryModel;
    }

    public function index()
    {
        $articles = $this->articleModel->get_all_join_table();
        $categories = $this->categoryModel->get_all();
        return $this->view("homes.index", [
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }
}
