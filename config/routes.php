<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 19.08.2018
 * Time: 11:31
 */

return [
    //'news/([a-zA-Z]+)/([a-zA-Z]+)' => 'news/detail/$2',
    'post/detail/([a-zA-Z]+)' => 'post/detail/$1',
    'post/sendcomment' => 'post/sendcomment',
    'post/search' => 'post/search',
    'posts/([a-zA-Z]+)' => 'post/categoryposts/$1',
    'about' => 'about/index',
    'contact/send' => 'contact/sendcontact',
    'contact' => 'contact/index',
    'index' => 'index/index',
    '^\s*$' => 'index/index',
];

?>