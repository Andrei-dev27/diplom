<?php
include_once "config.php";

function get_url($page = '') { 
    return HOST . "/$page";
}

function db() {
    try {
        return new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS,
            [
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //обработка ошибок
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC //вывод в ассоциативных массивах
            ]
    );
    }  catch(PDOException $e) {
        die($e->getMessage());
    }
}

function db_query($sql, $exec = false) { //наличие переменной $exec говорит о том, что SQL запрос нужно выполнить без возвращения результата 
    if(empty($sql)) return false;
     
    if($exec) return db()->exec($sql);
    
    return db()->query($sql);
}

function add_user($login, $pass) {
    $name = trim($login);
    $password = password_hash($pass, PASSWORD_DEFAULT);
    $img = $_FILES['avatar_img']['name'];
    $route = 'img/avatars/';
    $img_route = $route . $img;
    return db_query("INSERT INTO `users` (`id`, `pass`, `user_name`, `role_id`, `user_image`) VALUES (NULL, '$password', '$name', 2, '$img_route')", true);
} //добавляет пользователя в базу данных ("без вопросов")

function add_user_2($login, $pass) {
    $name = trim($login);
    $password = password_hash($pass, PASSWORD_DEFAULT);
    return db_query("INSERT INTO `users` (`id`, `pass`, `user_name`, `role_id`) VALUES (NULL, '$password', '$name', 2)", true);
} //добавляет пользователя в базу данных ("без вопросов")

// function add_avatar() {
//     echo db_query("SELECT user_image FROM users WHERE id = {$_SESSION['user']['id']}", true);
//     echo $_SESSION['user']['user_image'];
// }

function redirect($get_url) {
    header("Location:" .$get_url);
    die;
}

function register_user($auth_data) { //$auth_data - ассоциативный массив $_POST в файле sign_up.php
    if(empty($auth_data) || !isset($auth_data['login']) || empty($auth_data['login'])) return false;

    $user = get_user_info($auth_data['login']);
    if(!empty($user)) {
        $_SESSION['error'] = 'Пользователь ' .$auth_data['login']. ' уже существует!';
        redirect(get_url('registr.php'));
    }
    if(strlen($auth_data['pass']) < 8 || strlen($auth_data['pass']) > 20) {
        $_SESSION['error'] = 'Пароль содержит недопустимое количество символов!';
        redirect(get_url('registr.php'));
    }

    if($auth_data['pass'] !== $auth_data['pass2']) {
        $_SESSION['error'] = 'Пароли не совпадают!';
        redirect(get_url('registr.php'));
    }

    if( isset($_FILES['avatar_img']['tmp_name']) && !empty($_FILES['avatar_img']['tmp_name']) ){		
        $uploaddir = '../img/avatars/';
		$uploadfile = $uploaddir . basename($_FILES['avatar_img']['name']);
        // $tmp_name = 'img/avatars/';
        // $_FILES['avatar_img']['tmp_name'] = $tmp_name . basename($_FILES['avatar_img']['tmp_name']);
        if( move_uploaded_file($_FILES['avatar_img']['tmp_name'], $uploadfile) ) {
            if( add_user($auth_data['login'], $auth_data['pass']) ) {
                redirect(get_url('index.php?authModal=open'));
            }
            else {
                $_SESSION['error'] = 'При регистрации произошла ошибка!';
                redirect(get_url('registr.php'));
            }
        } else {
            $_SESSION['error'] = 'При загрузке файла произошла ошибка!';
            redirect(get_url('registr.php'));
        }
    }
    else{
        if(add_user_2($auth_data['login'], $auth_data['pass'])) {
            redirect(get_url('index.php?authModal=open'));
        } else {
                $_SESSION['error'] = 'При регистрации произошла ошибка!';
                redirect(get_url('registr.php'));   
        }
    }

} //осущевстляет дополнительные проверки: не пустая ли форма; совпадают ли пароли и т.д.

function get_error_message() {
    $error = '';
    if(isset($_SESSION['error']) && !empty($_SESSION['error'])) {
        $error = $_SESSION['error'];
        $_SESSION['error'] = '';
    }

    return $error;
}

function get_user_info($login) {
    return db_query(" SELECT * FROM `users` WHERE `user_name` = '$login' ") -> fetch();
} //возвращает информацию о пользователе, чтобы проверить, есть ли уже пользователь с таким логином 

function login($auth_data) {
    if(empty($auth_data) || !isset($auth_data['login']) || empty($auth_data['login'])) return false;
    
    $user = get_user_info($auth_data['login']);
    if(empty($user)) {
        $_SESSION['error'] = 'Пользователь ' .$auth_data['login']. ' не найден!';
        redirect(get_url('index.php?authModal=open') );
    }

    if(password_verify($auth_data['pass'], $user['pass']) ) {
        //$auth_data['pass'] - форма, $user['pass'] - БД
        $_SESSION['user'] = $user; //
        $_SESSION['error'] = '';
        redirect(get_url());
    } else{
        $_SESSION['error'] = 'Пароль неверный!';
        redirect(get_url('index.php?authModal=open') );
    }
    // debug($user, true);
} // принимает информацию с формы авторизации

function logout() {
    unset($_SESSION['user']);
    redirect(get_url());
}

function category_output() {
    return db_query(" SELECT * FROM `categories`  ") -> fetchAll();
}

function add_post($message, $link, $categorie) {
    $img = $_FILES['image']['name'];
    $route = 'img/posts_img/';
    $img_route = $route . $img;
    $user_id = $_SESSION['user']['id'];
    return db_query("INSERT INTO `posts` (`id`, `categorie_id`, `user_id`, `post_date`, `post_message`, `link`, `post_image`) 
    VALUES (NULL, $categorie, $user_id, NULL, '$message', '$link', '$img_route')", true);
}

function add_post_2($message, $link, $categorie) {
    $user_id = $_SESSION['user']['id'];
    return db_query("INSERT INTO `posts` (`id`, `categorie_id`, `user_id`, `post_date`, `post_message`, `link`) 
    VALUES (NULL, $categorie, $user_id, NULL, '$message', '$link')", true);
}

function create_post($post) {
    if(empty($post) || !isset($post)) return false;

    if(strlen($post['message_text']) > 300) {
        $_SESSION['error'] = 'Сообщение превышает допустимые размеры: сообщение не должно содержать болле 300 символов!';
        redirect(get_url('add_post.php'));
    }

    if( isset($_FILES['image']['tmp_name']) && !empty($_FILES['image']['tmp_name']) ){		
        $uploaddir = '../img/posts_img/';
		$uploadfile = $uploaddir . basename($_FILES['image']['name']);
        if( move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile) ) {
            if( add_post($post['message_text'], $post['link'], $post['categorie']) ) {
                redirect(get_url('index.php?db=1'));
            }
            else {
                $_SESSION['error'] = 'Во врямя добавления поста произошла ошибка!';
                redirect(get_url('add_post.php'));
            }
        } else {
            $_SESSION['error'] = 'При загрузке изображения произошла ошибка!';
            redirect(get_url('add_post.php'));
        }
    }
    else{
        if(add_post_2($post['message_text'], $post['link'], $post['categorie'])) {
            redirect(get_url('index.php?db=0'));
        } else {
                $_SESSION['error'] = 'Во врямя добавления поста произошла ошибка!';
                redirect(get_url('add_post.php'));   
        }
    }
}

function get_posts($id = 0) {
    if($id > 0) {
        if(isset($_GET['id']) && !empty($_GET['id'])) {
            return db_query("SELECT posts.*, users.user_name, users.user_image, users.role_id, categories.categorie_name
            FROM `posts` JOIN `users` ON posts.user_id=users.id 
            JOIN `categories` ON posts.categorie_id=categories.id 
            WHERE posts.user_id=$id
            ORDER BY posts.post_date DESC") -> fetchAll();
        } else if(isset($_GET['cat_id']) && !empty($_GET['cat_id'])) {
            return db_query("SELECT posts.*, users.user_name, users.user_image, users.role_id, categories.categorie_name
            FROM `posts` JOIN `users` ON posts.user_id=users.id 
            JOIN `categories` ON posts.categorie_id=categories.id 
            WHERE posts.categorie_id=$id
            ORDER BY posts.post_date DESC") -> fetchAll();
        }
    }
    return db_query("SELECT posts.*, users.user_name, users.user_image, users.role_id, categories.categorie_name
    FROM `posts` JOIN `users` ON posts.user_id=users.id 
    JOIN `categories` ON posts.categorie_id=categories.id
    ORDER BY posts.post_date DESC") -> fetchAll();
}

function get_categories() {
    return db_query("SELECT categories.* FROM `categories`") -> fetchAll();
}

function delete_post($post_id) {
    db_query("DELETE FROM `comments` WHERE post_id=$post_id");
    db_query("DELETE FROM `posts` WHERE id=$post_id");
    redirect(get_url());
}

function id_session($post_id) {
    $_SESSION['post_id_modal'] = $post_id;
    redirect(get_url("index.php?closeModal=open") );
}

function search_posts($search_word) {
    if(isset($search_word) && !empty($search_word)) {
        return db_query("SELECT posts.*, users.user_name, users.user_image, users.role_id, categories.categorie_name
        FROM `posts` JOIN `users` ON posts.user_id=users.id 
        JOIN `categories` ON posts.categorie_id=categories.id 
        WHERE (posts.post_message LIKE '%{$search_word}%')") -> fetchAll();
    } 
}

// function comment_id_session($post_id) {
//$_SESSION['post_id_modal'] = $post_id;
//     redirect(get_url('index.php?commentModal=open') );
// }
function add_comment($post_id, $comment_text) {
    $user_id = $_SESSION['user']['id'];
    db_query("INSERT INTO `comments` (`id`, `user_id`, `post_id`, `comment_date`, `comment_text`) VALUES (NULL, $user_id, $post_id, NULL, '$comment_text')");
}

function output_comment($post_id) {
    return db_query("SELECT comments.*, users.user_image, users.role_id
    FROM `comments` JOIN `users` ON comments.user_id=users.id
    WHERE comments.post_id={$post_id}") -> fetchAll();
}

// function output_comment_2($post_id) {
//     db_query("SELECT comments.*, users.user_image, users.role_id
//     FROM `comments` JOIN `users` ON comments.user_id=users.id
//     WHERE comments.post_id={$post_id}") -> fetchAll();
// }

function create_comment($comment) {
    if(isset($comment['text_comment']) && isset($comment['input_modal_post_id'])) {
        add_comment($comment['input_modal_post_id'], $comment['text_comment']);
        //функция, выгружающая все комментарии из БД
        $all_comments = output_comment($comment['input_modal_post_id']);
        if($all_comments) {
            return $all_comments;
        } else {
            return 10;
        }
    }
}

function save_id($post_id) {
    // $ajax_post_id = 0; 
    if(isset($post_id)) {
       return $post_id;
    } else {
        return 0;
    }
}


