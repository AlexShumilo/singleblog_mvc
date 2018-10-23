<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 18.09.2018
 * Time: 23:00
 */
include_once ROOT . '/components/Db.php';

class Model_Comment extends Db {

    public function __construct() {
        parent::__construct();
    }

    public function setComment($name, $email, $phone, $message, $postId) {
        $sql = $this->connection->prepare("INSERT INTO `comments`(`user_name`, `user_email`, `user_phone`, `com_text`, `post_id`) 
                                                VALUES (:name, :email, :phone, :message, :postId)");
        $sql->bindParam(':name', $name, PDO::PARAM_STR);
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->bindParam(':phone', $phone, PDO::PARAM_INT);
        $sql->bindParam(':message', $message, PDO::PARAM_STR);
        $sql->bindParam(':postId', $postId, PDO::PARAM_INT);
        $sql->execute();
    }

    public function getComments($postCode) {
        $sql = $this->connection->prepare("SELECT * FROM comments INNER JOIN blog_posts 
                                              ON comments.post_id = blog_posts.post_id WHERE post_code = :postCode ");
        $sql->bindParam(':postCode', $postCode, PDO::PARAM_STR);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>