<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 12.09.2018
 * Time: 19:02
 */
include_once ROOT . '/components/Db.php';

class Model_Blog extends Db {

    public function __construct() {
        parent::__construct();
    }

    public function getAllPosts($count = 3) {
        $sql = $this->connection->prepare("SELECT * FROM blog_posts ORDER BY post_date DESC LIMIT :count");
        $sql->bindParam(':count', $count, PDO::PARAM_INT);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLastPosts($limit = 3) {
        $sql = $this->connection->prepare("SELECT post_title, post_code FROM blog_posts ORDER BY post_date DESC LIMIT :limit");
        $sql->bindParam(':limit', $limit, PDO::PARAM_INT);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryPosts($category) {
        $sql = $this->connection->prepare("SELECT * FROM blog_posts INNER JOIN categories ON blog_posts.category_id = categories.cat_id 
                                                     WHERE categories.cat_code = :category");
        $sql->bindParam(':category', $category, PDO::PARAM_STR);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPostByCode($postCode) {
        $sql = $this->connection->prepare("SELECT * FROM blog_posts WHERE post_code = :postCode");
        $sql->bindParam(':postCode', $postCode, PDO::PARAM_STR);
        $sql->execute();

        return $sql->fetch();
    }
    public function getPostById($postId) {
        $sql = $this->connection->prepare("SELECT * FROM blog_posts WHERE post_id = :postId");
        $sql->bindParam(':postId', $postId, PDO::PARAM_INT);
        $sql->execute();

        return $sql->fetch();
    }

    public function searchPosts($search) {
        $search = "%{$search}%";
        $sql = $this->connection->prepare("SELECT * FROM blog_posts WHERE post_short_content LIKE :search OR post_content LIKE :search");
        $sql->bindParam(':search', $search, PDO::PARAM_STR);
        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>