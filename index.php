<?php 
    session_start();
    define('CSS_PATH', 'css/main.css');  
    echo $css;
    require_once 'partials/header.php';


    if (isset($_GET['page'])) {
    /**
     * Nun laden wir die Inhalte entsprechend des Wertes aus dem "page" GET-
     * Parameter.
     */
    if ($_GET['page'] === 'form') {
        require_once 'contents/form.php';
    } elseif ($_GET['page'] === 'tos') {
        require_once 'contents/tos.php';
    } else {
        /**
         * Wenn kein bekannter Wert in dem "page" GET-Paramater steht, dann
         * laden wir als "fallback" die Home Seite.
         */
        require_once 'contents/form.php';
    }
} else {
    /**
     * Ist der "page" GET-Paramater nicht gesetzt, so laden wir die Home Seite.
     */
    require_once 'contents/form.php';
}
    require_once 'partials/footer.php';
?>