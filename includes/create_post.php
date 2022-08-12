<div class="container-fluid section-add-message">
        <div class="wrapper-form-registr">
            <!-- form-registr -->
            <form action = <?php echo get_url('includes/post_data.php')?> method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleFormControlTextarea2" class="form-label">Добавьте текст сообщения</label>
                    <textarea type="text" class="form-control" id="exampleFormControlTextarea2" rows="3" name="message_text"></textarea>
                  </div>
                    <div id="passHelp" class="form-text margin-message-text">
                        Ваше сообщение не должно содержать болле 300 символов.                   
                    </div>
                <div class="mb-3">
                  <label for="exampleInputLink" class="form-label">Ссылка на источник</label>
                  <input type="text" class="form-control" id="exampleInputLink" name="link">
                </div>
                <div class="mb-3">
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="categorie">
                        <?php if($categories) { ?>
                            <option selected>Выберите технологию</option>
                            <?php foreach($categories as $categorie) {?>
                                <option value="<?php echo $categorie['id'];?>"><?php echo $categorie['categorie_name'];?></option>
                            <?php } ?>
                        <?php } else { ?>
                            <option selected>Технологии не найдены</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3 add-image">
                    <label for="exampleInputImage" class="form-label">Добавьте изображение</label>
                    <input type="file" name="image">
                </div>
                <?php if($error) {?>
                    <div class="post-form__error"><?php echo $error; ?></div>
                <?php }?>
                <div class="add-message">
                    <button type="submit" class="btn btn-primary btn-add-message">Отправить сообщение</button>
                </div>
            </form>
            <!-- form-registr -->
        </div>
</div>