<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
      WebForYou – микроблог для веб-разработчиков
    </title>
    <meta name="description" content="Актуальные новости в мире веб-разработки. Новая информация о самых востребованных технологиях: HTML, CSS, JS, PHP, Python">
    <meta name="keywords" content="веб-разработка, микроблог, новости, HTML, CSS, JS, PHP, Python">
    <link rel="icon" href="img/laptop-code-solid.svg" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="css/iconsfont.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="fixed-top">
      <div>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
          <div class="container-fluid">
            <!-- логотип -->
            <div class="logo">
              <i class="fa-solid fa-laptop-code"></i>
              <a class="navbar-brand" href="index.php">WebForYou</a>
            </div>
            <!-- кнопка бургер -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <!-- сворачиваемое содржимое -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <!-- левая часть -->
              <ul class="navbar-nav top-menu me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="index.php">Главная</a>
                </li>
                <li class="nav-item dropdown">
                  <div class="nav-link dropdown-color">
                    <a class="dropdown-toggle dropdown-color-a" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Категории
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <?php foreach($categories as $categorie) {?>
                        <li><a class="dropdown-item" href="index.php?cat_id=<?php echo $categorie['id']?>"> <?php echo $categorie['categorie_name'] ?> </a></li>
                      <?php } ?>  
                      <!-- <li><a class="dropdown-item" href="#">CSS</a></li>
                      <li><a class="dropdown-item" href="#">JS</a></li>
                      <li><a class="dropdown-item" href="#">PHP</a></li>
                      <li><a class="dropdown-item" href="#">Python</a></li> -->
                    </ul>
                  </div>
                </li>
                <?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])) { ?>
                <li class="nav-item">
                  <a class="nav-link" href="add_post.php">Создать сообщение</a>
                </li>
                <?php } ?>
              </ul>
              <!-- правая часть -->
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <!-- <li class="nav-item">
                  <a class="nav-link" href="#" id="icon-nav"> <i class="fa-solid fa-gear"></i> </a>
                </li> -->
                <li class="nav-item"  data-bs-toggle="modal" data-bs-target="#authModal">
                  <a class="nav-link user-home" href="#" id="icon-nav">
                    <!-- data-bs-toggle="tooltip" data-bs-placement="bottom" title="Авторизация" -->
                    <?php if($_SESSION['user']) {?>
                      <div class="nav-logo-img-wrapper">
                        <img class="nav-avatar" src="<?php echo $_SESSION['user']['user_image']; ?>" alt="Аватар пользователя">
                      </div> 
                    <?php }else {?>
                      <i class="fa-circle-user fa-regular icon-color"></i> 
                    <?php }?>
                  </a>
                </li>
              </ul>
              <form class="d-flex" action="<?php echo get_url('?search=1'); ?>" method="post">
                <input class="form-control me-2 max-with" type="search" placeholder="Поиск" aria-label="Search" id="search-nav" name="search">
                <button class="btn btn-color" type="submit"> <i class="fa-solid fa-magnifying-glass"></i> </button>
              </form>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <main>
 <!-- ModalAuth-->
      <div class="modal fade" id="authModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content modal-view">
            <div class="modal-header">
              <div class="logo-auth">
                <i class="fa-solid fa-laptop-code"></i>
                <a class="navbar-brand link-logo-auth" href="#">WebForYou</a>
              </div>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-wrapper">
              <h2 class="header-form-auth">Введите логин и пароль</h2>
              <div class="link-registr-wrapp">
                Впервые на сайте? Пройдите
                <a href="<?php echo get_url('registr.php'); ?>" class="link-registr">регистрацию</a>
              </div>
              <!-- $_SESSION['error'] -->
              <?php if($error) {?>
                <div class="post-form__error"><?php echo $error; ?></div>
              <?php }?>
              <form action="<?php echo get_url('includes/sign_in.php'); ?>" method="post">
                <div class="row form-auth-flex">
                  <div class="col-auto form-margin-top-bottom">
                    <input type="text" id="inputLogin" class="form-control" name="login" placeholder="Логин">
                  </div>
                  <div class="col-auto form-margin-top-bottom">
                    <input type="password" id="inputPassword" class="form-control" name="pass" aria-describedby="passwordHelpInline" placeholder="Пароль">
                  </div>
                  <div class="btn-auth">
                    <button type="submit" class="btn btn-primary">Войти</button>
                    <!-- ломает сайт -->
                    <?php if(isset($_SESSION['user']) && !empty($_SESSION['user'])) { ?>
                      <button type="button" class="btn btn-primary btn-margin-left">
                        <a href="<?php echo get_url('includes/logout.php'); ?>">Выйти</a>
                      </button>
                    <?php } ?>
                    <!-- ломает сайт -->
                  </div>
                </div>
              </form>
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Understood</button>
            </div> -->
          </div>
        </div>
      </div>
    <!-- div под header-->
    <div class="section-1 container-fluid"> </div>