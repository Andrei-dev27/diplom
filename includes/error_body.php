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