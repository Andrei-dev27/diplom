<?php
include_once "functions.php";
// if(isset($_POST['post_id'])) id_session($_POST['post_id']);

if(isset($_GET['post_id'])) delete_post($_GET['post_id']);
