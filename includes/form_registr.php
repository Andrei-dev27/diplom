<div class="container-fluid section-registr">
  <div class="wrapper-form-registr">
<!-- form-registr -->
    <form action = <?php echo get_url('includes/sign_up.php'); ?> method="post" enctype="multipart/form-data">
      <div class="logo-choice">
        <div class="logo-img-wrapper margin-img-wrapper">
          <img class="avatar" src="img/avatars/avatar_user.jpg" alt="Аватар пользователя">
          <input class="custom-file-input" type="file" name="avatar_img">
        </div>
      </div>
      <?php if($error) {?>
      <div class="post-form__error"><?php echo $error; ?></div>
      <?php }?>
      <div class="mb-3">
        <label for="exampleInputLogin1" class="form-label">Логин</label>
        <input type="text" class="form-control" id="exampleInputLogin1" name="login">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Пароль</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="pass">
        <div id="passHelp" class="form-text">
          Ваш пароль должен состоять из 8-20 символов.
        </div>
      </div>
      <div class="mb-3">
          <label for="exampleInputPassword2" class="form-label">Пароль повторно</label>
          <input type="password" class="form-control" id="exampleInputPassword2" name="pass2">
          <div id="passHelp" class="form-text">
              Пароли должны совпадать.
          </div>
      </div>
      <button type="submit" class="btn btn-primary btn-registr">Зарегистрироваться</button>
    </form>
<!-- form-registr -->
  </div>
</div>