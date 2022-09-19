<?php
include_once "functions.php";

// echo 'Мы на месте!';
if(isset($_POST['text_comment']) && isset($_POST['input_modal_post_id'])) {
    $new_comments = create_comment($_POST);
    if(isset($new_comments) && $new_comments != 10) {
        foreach($new_comments as $new_comment) {
            $date = date('d.m.y в H:i', strtotime($new_comment['comment_date']) );
            $image = $new_comment['user_image'];
            $comment_text = $new_comment['comment_text'];
            echo "<div class='wrapper-comment-modal'>
                <div class='user-add-comment'>
                    <a href='#'>
                        <div class='logo-img-wrapper-modal'>
                            <img class='avatar-modal' src='{$image}' alt='Аватар пользователя'>
                        </div>
                    </a>
                    <div class='date-add-comment'>
                        <time class='post-add'> {$date} </time>
                    </div>
                </div>
                <div class='text-comment'>
                    <p>{$comment_text}</p>
                </div>
            </div>";
        }
    } else if(isset($new_comments) && $new_comments == 10){
        echo "Функция, выгружающая все комментарии из БД, ничего не возвращает!";
    } else{
        echo "Комментарии не взяты из БД!";
    }
}  



