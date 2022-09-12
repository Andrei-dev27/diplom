<?php
include_once "functions.php";
// session_destroy();
echo "Подебажим? <br>";
$_SESSION['zn-1'] = 'qwerty';
$_SESSION['zn-2'] = 'ytrewq';
$s = $_SESSION;

foreach ($s as $k => $v) {
    echo "{$k} => {$v} <br>";
    if(is_array($v)) {
        echo '<br>';
        foreach ($v as $k2 => $v2) {
            echo "{$k}: {$k2} => {$v2} <br>";
        }
    }
}
echo "id-шка: {$_SESSION['user']['id']}";
echo "<br> text_comment: {$_POST['text_comment']}";
echo  "<br> post_id_for_comment: {$_POST['post_id_for_comment']}";

// $error = 'abc';
echo $error;

// <div class="wrapper-comment-modal">
// <div class="user-add-comment">
//   <a href="#">
//     <div class="logo-img-wrapper-modal">
//       <img class="avatar-modal" src="img/avatars/Фото Жогаль Е.jpg" alt="Аватар пользователя">
//     </div>
//   </a>
//   <div class="date-add-comment">
//     <time class="post-add">
//       07.01.21 в 15:52
//     </time>
//     <!-- <a class="user-link" href="#">Артём</a> -->
//   </div>
// </div>
// <div class="text-comment">
//   <p>
//     По своей сути рыбатекст является альтернативой традиционному lorem ipsum, 
//     который вызывает у некторых людей недоумение при попытках прочитать рыбу текст.
//     По своей сути рыбатекст является альтернативой традиционному lorem ipsum 
//   </p>
// </div>
// </div>
// <div class="wrapper-comment-modal">
// <div class="user-add-comment">
//   <a href="#">
//     <div class="logo-img-wrapper-modal">
//       <img class="avatar-modal" src="img/avatars/Фото Жогаль Е.jpg" alt="Аватар пользователя">
//     </div>
//   </a>
//   <div class="date-add-comment">
//     <time class="post-add">
//       07.01.21 в 15:52
//     </time>
//     <!-- <a class="user-link" href="#">Артём</a> -->
//   </div>
// </div>
// <div class="text-comment">
//   <p>
//     По своей сути рыбатекст является альтернативой традиционному lorem ipsum, 
//     который вызывает у некторых людей недоумение при попытках прочитать рыбу текст.
//     По своей сути рыбатекст является альтернативой традиционному lorem ipsum 
//   </p>
// </div>
// </div>