<?php
include_once "functions.php";

// echo 'Мы на месте!';
if(isset($_POST['ajax_post_id'])) {
    $_SESSION['ajax_post_id'] = $_POST['ajax_post_id'];
} else {
    $_SESSION['ajax_post_id'] = 0;
}

