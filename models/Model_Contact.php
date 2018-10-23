<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 18.09.2018
 * Time: 22:26
 */
include_once ROOT . '/components/Db.php';

class Model_Contact extends Db {

    public function __construct() {
        parent::__construct();
    }

    public function setContact($name, $email, $phone, $city, $message) {
        $sql = $this->connection->prepare("INSERT INTO `contacts`(`cont_name`, `cont_email`, `cont_phone`, `cont_city`, `cont_message`) 
                                                VALUES (:name, :email, :phone, :city, :message)");
        $sql->bindParam(':name', $name, PDO::PARAM_STR);
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->bindParam(':phone', $phone, PDO::PARAM_INT);
        $sql->bindParam(':city', $city, PDO::PARAM_STR);
        $sql->bindParam(':message', $message, PDO::PARAM_STR);
        $sql->execute();
    }
}

?>