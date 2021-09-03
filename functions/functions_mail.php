<?php

if(isset($postArray['submit'])){

    $errors = array();
    $hasError = false;            

    //$post = filter_input(INPUT_POST, "name", FILTER_DEFAULT)
    
        if ($postArray) {
            if (in_array("", $postArray)) {
                
                $errors[] = esc_html_e("Please fill in all fields", "jg-mail");
                $hasError = true;

    
            } elseif (!filter_var($postArray['message_email'], FILTER_VALIDATE_EMAIL)) {
    
                $errors[] = esc_html_e("Please enter a valid email address", "jg-mail");
                $hasError = true;
    
            } else {
    /* 
                $saveStrip = array_map("strip_tags", $postArray);
                $save = array_map("trim", $saveStrip);
                var_dump($save); */
                echo "<p class='trigger accept'>Cadastro com sucesso!</p>";
    
            }
        }
    

}

