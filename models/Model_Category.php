<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 12.09.2018
 * Time: 23:06
 */
include_once ROOT . '/components/Db.php';

class Model_Category extends Db {

    public function __construct() {
        parent::__construct();
    }

    public function getCategories($limit = 6) {
        $sql = $this->connection->prepare("SELECT * FROM categories LIMIT :limit");
        $sql->bindParam(':limit', $limit, PDO::PARAM_INT);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>