<?php
include_once "functions.php";

if(isset($_POST)) {
    $p = $_POST;
    if(isset($p['message_text'], $p['link'], $p['categorie'])) create_post($p);
} 



