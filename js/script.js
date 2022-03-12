let userHome = document.querySelector('a .nav-link, .user-home');
let user = document.querySelector('.fa-circle-user, .fa-regular');

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

// let commentButton = document.querySelector('.post-button-selector');
// let comment = document.querySelector('.comment-selector');
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



