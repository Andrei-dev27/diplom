<?php
include_once "functions.php";

// echo 'Мы на месте!';
if(isset($_POST['post_id_for_comment'])) comment_id_session($_POST['post_id_for_comment']);