<?php

/**
 * Description of ProductView
 *
 * @author tarda
 */
class ProductView {

    public function __construct() {
        
    }

    public function display($template = NULL, $content = NULL) {
        include("view/menu/MainMenu.html");
        
        if (!empty($template)) {
            include($template);
        }

        include("view/form/MessageForm.php");
    }

}
