<?php

/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 29.08.2018
 * Time: 18:50
 */
class Controller {
    protected $view;

    function __construct() {
        $this->view = new View();
    }
}
?>