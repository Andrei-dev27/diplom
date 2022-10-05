<?php
include_once "functions.php";

// echo "Пришли на сервер!";
if(isset($_POST['post_id']) && isset($_POST['user_id']) && isset($_POST['add_remove'])) {
    if($_POST['add_remove'] == 'add') {
        // echo "Пришли добавить лайк!";
        add_like($_POST['post_id'], $_POST['user_id']);
    } else if($_POST['add_remove'] == 'remove') {
        // echo "Пришли удалить лайк!";
        remove_like($_POST['post_id'], $_POST['user_id']);
    }
    echo likes_count($_POST['post_id']);
}