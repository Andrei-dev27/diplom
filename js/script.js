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

let likeButton = document.querySelector('.like-post-button');
let like = document.querySelector('.like-selector'); //i .fa-thumbs-up, .fa-regular

likeButton.addEventListener('click', ()=> {
    if(like.classList.contains('fa-regular')) {
        like.classList.add('fa-solid')
        like.classList.remove('fa-regular')
    } else if(like.classList.contains('fa-solid')) {
        like.classList.add('fa-regular')
        like.classList.remove('fa-solid')
    }
})

let commentButton = document.querySelector('.post-button-selector');
let comment = document.querySelector('.comment-selector');
let postIds = document.querySelectorAll('.post_id').getAttribute('value');

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

commentButton.addEventListener('click', ()=> {
    for (let postId of postIds) {
        alert(postId);
      }
})


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
    const elemModal_close = document.querySelector('#closeModal');
    const elemModal_comment = document.querySelector('#commentModal');
    // активируем элемент в качестве модального окна с параметрами по умолчанию
    const modal_auth = new bootstrap.Modal(elemModal_auth);
    const modal_close = new bootstrap.Modal( elemModal_close);
    const modal_comment = new bootstrap.Modal( elemModal_comment);
    if(window.location.search == '?authModal=open') {
        modal_auth.show();
    } else if(window.location.search == '?closeModal=open') {
        modal_close.show();
    } else if(window.location.search == '?commentModal=open') {
        modal_comment.show();
    }
  });
  


