<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 13.09.2018
 * Time: 9:40
 */
include_once ROOT . '/controllers/Controller.php';
include_once ROOT . '/models/Model_Contact.php';

class ContactController extends Controller {

    private $contactModel;

    public function __construct() {
        parent::__construct();
        $this->contactModel = new Model_Contact();
    }

    public function actionIndex() {
        try {
            $this->view->generate('template_view.phtml', 'contact/index.phtml');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function actionSendcontact() {
        try {
            function clean($value = "") {                               // очистка пришедших данных от ненужных символов
                $value = trim($value);
                $value = stripslashes($value);
                $value = strip_tags($value);
                $value = htmlspecialchars($value);

                return $value;
            }
            $result = true;

            if (isset($_POST['submit']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && $_POST['city'] && $_POST['message']) {
                $_POST['name'] = clean($_POST['name']);
                $_POST['email'] = clean($_POST['email']);
                $_POST['phone'] = clean($_POST['phone']);
                $_POST['city'] = clean($_POST['city']);              // если форма пришла, то записываем безопасные данные в базу
                $_POST['message'] = clean($_POST['message']);

                $this->contactModel->setContact($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['city'], $_POST['message']);
            } else {
                return $result = false;                                 // если форма не пришла или не со всеми данными, то ставим флаг false
            }
            $this->view->result = $result;

            $this->view->generate('template_view.phtml', 'contact/sendcontact.phtml');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

?>