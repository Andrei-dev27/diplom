function getComments(postId) {
    let textComment = document.getElementById(`text_comment${postId}`).value;
    let postID = document.getElementById(`input_modal_post_id${postId}`).value;

    let xml = new XMLHttpRequest();
    xml.onreadystatechange = function() {
        if(xml.readyState == 4 && xml.status == 200) {
            if(this.responseText == 'Нет комментария!') {
                document.querySelector('.post-form__error').innerHTML = this.responseText;
            } else{
                document.querySelector(`#answer${postId}`).innerHTML = this.responseText;
                document.querySelector('.post-form__error').innerHTML = '';
                let wrapperComments = document.querySelector(`#answer${postId}`);
                let classesComments = wrapperComments.querySelectorAll('.wrapper-comment-modal');
                document.querySelector(`#counter-comments${postId}`).innerHTML = classesComments.length;
            }
        }
    }
    xml.open("POST", "http://localhost/microblog/includes/create_comment.php", true);
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xml.send('text_comment='+ textComment + '&input_modal_post_id=' + postID);
}

function addRemoveLike(postId, userId, addRemove) {
    // alert(`${postId}, ${userId}, ${addRemove}`)
    let xml2 = new XMLHttpRequest()
    xml2.onreadystatechange = function() {
        if(xml2.readyState == 4 && xml2.status == 200) {
            document.querySelector(`#counter-likes${postId}`).innerHTML = this.responseText;
            // alert(this.responseText)
        }
    }
    xml2.open("POST", "http://localhost/microblog/includes/get_remove_likes.php", true)
    xml2.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    xml2.send('post_id='+ postId + '&user_id=' + userId + '&add_remove=' + addRemove)

}

function getRemoveLike(postId, userId) {
    // let likeButton = document.querySelector('.like-post-button');
    let like = document.querySelector(`#like${postId}`); //i .fa-thumbs-up, .fa-regular

        if(like.classList.contains('fa-regular')) {
            like.classList.add('fa-solid')
            like.classList.remove('fa-regular')
            if(like.classList.contains('fa-solid')) {
                let label = 'add'
                addRemoveLike(postId, userId, label)
            }
        } else if(like.classList.contains('fa-solid')) {
            like.classList.add('fa-regular')
            like.classList.remove('fa-solid') 
            if(like.classList.contains('fa-regular')) {
                let label = 'remove'
                addRemoveLike(postId, userId, label)
            }
        }
}

//<?php echo regular_solid($post['id'], $_SESSION['user']['id'])?>

let userHome = document.querySelector('a .nav-link, .user-home');
let user = document.querySelector('.fa-circle-user');

if(user) {
    userHome.addEventListener('mouseover', ()=> {
        if(user.classList.contains('fa-regular')) {
            user.classList.add('fa-solid')
            user.classList.remove('fa-regular')
        }
    })
    userHome.addEventListener('mouseout', ()=> {
        if(user.classList.contains('fa-solid')) {
            user.classList.add('fa-regular')
            user.classList.remove('fa-solid')
        }
    })
}

// commentButton.addEventListener('mouseover', ()=> {
//     if(comment.classList.contains('fa-regular')) {
//         comment.classList.add('fa-solid')
//         comment.classList.remove('fa-regular')
//     }
// })
// commentButton.addEventListener('mouseout', ()=> {
//     if(comment.classList.contains('fa-solid')) {
//         comment.classList.add('fa-regular')
//         comment.classList.remove('fa-solid')
//     }
// })

let commentButtons = document.querySelectorAll('.post-button-selector');
let comment = document.querySelector('.comment-selector');
// let postId = document.querySelector('.post_id').getAttribute('value');



let modalPostId = document.querySelector('div .modal_post_id');
function showMessage(postIdPhp) {
    if(typeof modalPostId != null && typeof modalPostId != undefined) {
        if(typeof postIdPhp != null && typeof postIdPhp != undefined) {
            // alert(postIdPhp)
            return modalPostId.innerHTML = `<input id="input_modal_post_id" type="hidden" name="input_modal_post_id" value="${postIdPhp}">`
        }
    }

    // const ul = document.modalPostId.createElement("ul");
    // return ul.innerHTML = `<li> ${postIdPhp} </li>`;
    // modalPostId.innerHTML = ' '; //`name='post_id_modal' value='13'`
    // return modalPostId;
}

// после загрузки страницы
// window.addEventListener('load', function () {
//     // // элемент, содержащий контент модального окна (например, имеющий id="modal")
//     // const elemModal = document.querySelector('#staticBackdrop');
//     // // активируем элемент в качестве модального окна с параметрами по умолчанию
//     // const modal = new bootstrap.Modal(elemModal);

//     // элемент, содержащий контент модального окна (например, имеющий id="modal")
//     const elemModalTwo = document.querySelector('#closeModal');
//     // активируем элемент в качестве модального окна с параметрами по умолчанию
//     const modalTwo = new bootstrap.Modal(elemModalTwo);
//     // откроем модальное окно

//     if(window.location.search == '?modal=open') {
//         modal.show();
//     } 
//     // else if(window.location.search == '?closeModal=open') {
//     //     modal.show();
//     // }
//   });

  window.addEventListener('load', function () {
    // элемент, содержащий контент модального окна (например, имеющий id="modal")
    // const elemModalTwo = document.querySelector('#closeModal');
    // // активируем элемент в качестве модального окна с параметрами по умолчанию
    // const modalTwo = new bootstrap.Modal(elemModalTwo);
    // // откроем модальное окно

    // элемент, содержащий контент модального окна (например, имеющий id="modal")
    const elemModal_auth = document.querySelector('#authModal');
    const elemModal_comment = document.querySelector('#commentModal');
    // активируем элемент в качестве модального окна с параметрами по умолчанию
    const modal_auth = new bootstrap.Modal(elemModal_auth);
    // const modal_close = new bootstrap.Modal( elemModal_close);
    // else if(window.location.search == '?closeModal=open') {
    //     modal_close.show();
    // }
    const modal_comment = new bootstrap.Modal( elemModal_comment);
    if(window.location.search == '?authModal=open') {
        modal_auth.show();
    } else if(window.location.search == '?commentModal=open') {
        modal_comment.show();
    }
  });

  function closeModal(postId) {
    // alert(`ID поста для удаления: ${postId}`)
    const elemModal_close = document.querySelector(`#closeModal${postId}`);
    const modal_close = new bootstrap.Modal( elemModal_close);
    if(window.location.search == '?closeModal=open') {
        modal_close.show();
    }
  }

//   <form action="<?php echo get_url('includes/delete_post.php'); ?>" method="post">
//   <input type="hidden" name="post_id" value="<?php echo $post['id']?>">
//   <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-bs-toggle="modal" data-bs-target="#closeModal<?php echo $post['id']?>" onclick="closeModal(<?php echo $post['id']?>)"></button>
// </form>
  
  


