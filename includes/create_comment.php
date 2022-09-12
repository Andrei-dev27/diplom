<?php
include_once "functions.php";

// echo 'Мы на месте!';
if(isset($_POST['text_comment']) && isset($_POST['input_modal_post_id']))  create_comment($_POST);