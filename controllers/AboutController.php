<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 13.09.2018
 * Time: 9:31
 */
include_once ROOT . '/controllers/Controller.php';

class AboutController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function actionIndex() {
        try {
            $this->view->generate('template_view.phtml', 'about/index.phtml');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

?>