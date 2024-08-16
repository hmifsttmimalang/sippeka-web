<?php

class HomeController {
    public function index() {
        ob_start();
        include 'views/layout/header.php';
        include 'views/index.php';
        include 'views/layout/footer.php';
        return ob_get_clean();
    }
}
