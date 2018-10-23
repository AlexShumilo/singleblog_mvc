<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 30.08.2018
 * Time: 22:30
 */
include_once ROOT . '/controllers/Controller.php';
include_once ROOT . '/models/Model_Blog.php';
include_once ROOT . '/models/Model_Category.php';

class IndexController extends Controller {
    private $blogModel;
    private $categoryModel;

    function __construct() {
        parent::__construct();
        $this->blogModel = new Model_Blog();
        $this->categoryModel = new Model_Category();
    }

    public function actionIndex() {
        try {

            $this->view->posts = $this->blogModel->getAllPosts();
            $this->view->lastPosts = $this->blogModel->getLastPosts(4);
            $this->view->categories = $this->categoryModel->getCategories();

            $this->view->generate('template_view.phtml', 'layouts/index.phtml');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>