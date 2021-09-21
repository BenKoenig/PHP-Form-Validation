<?php 
    session_start();
    define('CSS_PATH', 'css/main.css');  
    echo $css;
    require_once 'partials/header.php';
    require_once 'contents/form.php';
    require_once 'partials/footer.php';
?>