<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 12.09.2018
 * Time: 23:21
 */
include_once ROOT . '/controllers/Controller.php';
include_once ROOT . '/models/Model_Category.php';
include_once ROOT . '/models/Model_Blog.php';
include_once ROOT . '/models/Model_Comment.php';

class PostController extends Controller {
    private $categoryModel;
    private $blogModel;
    private $commentModel;

    public function __construct() {
        parent::__construct();
        $this->categoryModel = new Model_Category();
        $this->blogModel = new Model_Blog();
        $this->commentModel = new Model_Comment();
    }

    public function actionCategoryposts($category) {
        try {
            $this->view->posts = $this->blogModel->getCategoryPosts($category);
            $this->view->categories = $this->categoryModel->getCategories();
            $this->view->lastPosts = $this->blogModel->getLastPosts(4);

            $this->view->generate('template_view.phtml', 'posts/index.phtml');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function actionDetail($postCode) {
        try {
            $this->view->post = $this->blogModel->getPostByCode($postCode);
            $this->view->comments = $this->commentModel->getComments($postCode);
            $this->view->categories = $this->categoryModel->getCategories();
            $this->view->lastPosts = $this->blogModel->getLastPosts(4);

            $this->view->generate('template_view.phtml', 'posts/post.phtml');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function actionSendcomment() {
        try {
            $result = true;

            if (isset($_POST['submit']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['message'])) {
                $_POST['name'] = $this->clean($_POST['name']);
                $_POST['email'] = $this->clean($_POST['email']);
                $_POST['phone'] = $this->clean($_POST['phone']);               // если форма пришла, то записываем безопасные данные в базу
                $_POST['message'] = $this->clean($_POST['message']);

                $this->commentModel->setComment($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['message'], $_POST['post_id']);
            } else {
                return $result = false;                                 // если форма не пришла или не со всеми данными, то ставим флаг false
            }

            $this->view->postLink = $this->blogModel->getPostById($_POST['post_id']);
            $this->view->categories = $this->categoryModel->getCategories();
            $this->view->lastPosts = $this->blogModel->getLastPosts(4);
            $this->view->result = $result;

            $this->view->generate('template_view.phtml', 'posts/sendcomment.phtml');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function actionSearch() {
        try {
            if (isset($_POST['submit']) && isset($_POST['search'])) {
                $_POST['search'] = $this->clean($_POST['search']);

                $result = $this->blogModel->searchPosts($_POST['search']);
            }

            $this->view->categories = $this->categoryModel->getCategories();
            $this->view->lastPosts = $this->blogModel->getLastPosts(4);
            $this->view->posts = $result;

            $this->view->generate('template_view.phtml', 'posts/index.phtml');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function clean($value = "") {                                // очистка пришедших данных от ненужных символов
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);

        return $value;
    }
}
?>