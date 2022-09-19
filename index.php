<?php
include_once "includes/functions.php";
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $posts = get_posts($_GET['id']);
} else if(isset($_GET['cat_id']) && !empty($_GET['cat_id'])) {
    $posts = get_posts($_GET['cat_id']);
} else if(isset($_GET['search']) && !empty($_GET['search'])) {
    $posts = search_posts($_POST['search']);
} else{
    $posts = get_posts();
}
$categories = get_categories();
$error = get_error_message();

include_once "includes/header.php"; 
include_once "includes/posts.php";
include_once "includes/footer.php";