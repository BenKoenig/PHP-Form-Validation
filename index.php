<?php 
    session_start();
    define('CSS_PATH', 'css/main.css');  
    echo $css;
    require_once 'partials/header.php';


    if (isset($_GET['page'])) {
    if ($_GET['page'] === 'form') {
        require_once 'contents/form.php';
    } elseif ($_GET['page'] === 'tos') {
        require_once 'contents/tos.php';
    } else {
        require_once 'contents/form.php';
    }
} else {
    require_once 'contents/form.php';
}
    require_once 'partials/footer.php';
?>