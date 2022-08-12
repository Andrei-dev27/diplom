<?php if($posts) {
  foreach($posts as $post) { ?>
    <!-- основной информационный блок -->
    <div class="section container-fluid p-5">
    <input class="post_id" type="hidden" name="post_id_for_modal" value="<?php echo $post['id']?>">
    <!-- кнопка удаления -->
        <div class="close">
          <?php if($_SESSION['user']['role_id'] == 1 || $_SESSION['user']['id'] == $post['user_id']) { ?>
            <form action="<?php echo get_url('includes/delete_post.php'); ?>" method="post">
              <input type="hidden" name="post_id" value="<?php echo $post['id']?>">
              <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="modal" data-bs-target="#closeModal"></button>
            </form>
            <!-- <a href="index.php?modal=op"> </a> -->
              <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="modal" data-bs-target="#closeModal"> 
              </button> -->
          <?php } ?>
            <!-- ModalClose -->
            <div class="modal fade" id="closeModal" tabindex="-1" aria-labelledby="closeModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header modal-header-flex">
                    <!-- <h5 class="modal-title" id="closeModalLabel">Хотите удалить сообщение?</h5> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body modal-footer-flex">
                      <div class="modal-question">
                        <h5 class="modal-title" id="closeModalLabel">Хотите удалить сообщение?</h5>
                      </div>
                      <div class="modal-btn-flex">
                        <button type="button" class="btn btn-primary btn-footer-width" data-bs-dismiss="modal">Отмена</button>

                        <a class="btn-footer-width" href="includes/delete_post.php?post_id=<?php echo $_SESSION['post_id_modal'];?>"><button type="button" class="btn btn-primary btn-footer-width-a"> Удалить </button></a>
                      </div>
                  </div>
                  <!-- <div class="modal-footer modal-footer-flex">

                  </div> -->
                </div>
              </div>
            </div>
            <!-- ModalClose -->
        </div>
        <div class="row height-info-bloсk">
            <!-- блок с картинкой -->
            <div class="col-md-6 col-sm-12 section-image px-3 order-1"> 
              <div class="img-wrapper">
                <img src="<?php echo $post['post_image'];?>" alt="post image">
              </div>
            </div>
            <!-- блок с сообщением -->
            <div class="col-md-6 col-sm-12 section-text-mobile my-md-auto my-4 order-2">
              <div class="h-flex-container">
                <!-- пользователь, технология, дата -->
                <div class="user">
                  <a href="index.php?id=<?php echo $post['user_id'];?>" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" title="<div> <?php echo $post['user_name'];?> </div>">
                    <div class="logo-img-wrapper">
                      <img class="avatar" id = "<?php echo $post['user_id'];?>" src="<?php echo $post['user_image'];?>" alt="Аватар пользователя">
                    </div>
                  </a> 
                  <div class="date-technology">
                    <a href="index.php?cat_id=<?php echo $post['categorie_id'];?>">
                      <div class="technology">
                        <?php
                          switch($post['categorie_name'])
                          {
                              case 'HTML': 
                                  echo "<i class='fa-brands fa-html5'></i>";
                                  break;
                              case 'CSS': 
                                  echo "<i class='fa-brands fa-css3-alt'></i>";
                                  break;
                              case 'JS': 
                                  echo "<i class='fa-brands fa-js-square'></i>";
                                  break;
                              case 'PHP': 
                                  echo "<i class='fa-brands fa-php'></i>";
                                  break;
                              case 'Python':
                                  echo "<i class='fa-brands fa-python'></i>";
                                  break;
                          }
                        ?> 
                      </div>
                    </a>
                    <time class="post-add">
                      <?php echo date('d.m.y в H:i', strtotime($post['post_date']) );?>
                    </time>
                    <!-- <a class="user-link" href="#">Артём</a> -->
                  </div>
                </div>
                <!-- текст сообщения -->
                <div class="text-post">
                  <p>
                    <?php echo $post['post_message'];?>
                  </p>
                </div>
                <!-- ссылка на ресурс -->
                <a class="resource-link" href="<?php echo $post['link'];?>">
                  <div class="resource" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="right" title="<?php echo $post['link'];?>">
                    <div class="text-link"> Читать </div>
                    <i class="fa-solid fa-arrow-right-long"></i>
                  </div>
                </a>
                <!-- лайк-комментарий -->
                <div class="post-like-comment">
                  <div class="comment-like">
                    <button type="button" class="like-post-button"> 
                      <i class="like-selector icon-color fa-thumbs-up fa-regular"></i>
                      <div class="counter-likes">7</div> 
                    </button> 
                  </div>
                  <div class="comment-like"> 
                  <button type="submit" class="like-post-button post-button-selector" data-bs-toggle="modal" data-bs-target="#commentModal"> 
                        <i class="comment-selector icon-color fa-regular fa-comment"></i>
                        <div class="counter-comments">8</div>
                  </button> 
                  <!-- <form method="post" action="includes/create_comment.php">

                  </form> -->
                  </div>
                </div>
              </div>
            </div>
        </div>
        <!-- ModalComment -->
    <div class="modal fade" id="commentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticCommentLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <div class="logo-auth">
                  <i class="fa-solid fa-laptop-code"></i>
                  <a class="navbar-brand link-logo-auth" href="#">WebForYou</a>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="post" action="includes/error_body.php"> 
                  <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Добавьте комментарий</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="text_comment"></textarea>
                  </div>
                  <button class="btn btn-primary btn-add-comment" type="submit">Добавить</button>
                </form>
                <div class="wrapper-comment-modal">
                  <div class="user-add-comment">
                    <a href="#">
                      <div class="logo-img-wrapper-modal">
                        <img class="avatar-modal" src="img/avatars/Фото Жогаль Е.jpg" alt="Аватар пользователя">
                      </div>
                    </a>
                    <div class="date-add-comment">
                      <time class="post-add">
                        07.01.21 в 15:52
                      </time>
                      <!-- <a class="user-link" href="#">Артём</a> -->
                    </div>
                  </div>
                  <div class="text-comment">
                    <p>
                      По своей сути рыбатекст является альтернативой традиционному lorem ipsum, 
                      который вызывает у некторых людей недоумение при попытках прочитать рыбу текст.
                      По своей сути рыбатекст является альтернативой традиционному lorem ipsum 
                    </p>
                  </div>
                </div>
                <div class="wrapper-comment-modal">
                  <div class="user-add-comment">
                    <a href="#">
                      <div class="logo-img-wrapper-modal">
                        <img class="avatar-modal" src="img/avatars/Фото Жогаль Е.jpg" alt="Аватар пользователя">
                      </div>
                    </a>
                    <div class="date-add-comment">
                      <time class="post-add">
                        07.01.21 в 15:52
                      </time>
                      <!-- <a class="user-link" href="#">Артём</a> -->
                    </div>
                  </div>
                  <div class="text-comment">
                    <p>
                      По своей сути рыбатекст является альтернативой традиционному lorem ipsum, 
                      который вызывает у некторых людей недоумение при попытках прочитать рыбу текст.
                      По своей сути рыбатекст является альтернативой традиционному lorem ipsum 
                    </p>
                  </div>
                </div>
                <div class="wrapper-comment-modal">
                  <div class="user-add-comment">
                    <a href="#">
                      <div class="logo-img-wrapper-modal">
                        <img class="avatar-modal" src="img/avatars/Фото Жогаль Е.jpg" alt="Аватар пользователя">
                      </div>
                    </a>
                    <div class="date-add-comment">
                      <time class="post-add">
                        07.01.21 в 15:52
                      </time>
                      <!-- <a class="user-link" href="#">Артём</a> -->
                    </div>
                  </div>
                  <div class="text-comment">
                    <p>
                      По своей сути рыбатекст является альтернативой традиционному lorem ipsum, 
                      который вызывает у некторых людей недоумение при попытках прочитать рыбу текст.
                      По своей сути рыбатекст является альтернативой традиционному lorem ipsum 
                    </p>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Закрыть</button>
              </div>
            </div>
          </div>
        </div>
 <!-- ModalComment -->
    </div>
  <?php }
}?>