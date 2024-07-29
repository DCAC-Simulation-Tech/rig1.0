function openModal() {
    document.getElementById('modal').style.display = 'block';
}

function closeModal() {
    document.getElementById('modal').style.display = 'none';
}

// document.getElementById('waitlistForm').addEventListener('submit', function(e) {
//     e.preventDefault();

//     const formData = new FormData(this);

//     fetch('submit_form.php', {
//         method: 'POST',
//         body: formData
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.success) {
//             alert('Thank you for joining the waitlist!');
//             closeModal();
//             loadComments();
//         } else {
//             alert('There was an error. Please try again.');
//         }
//     });
// });

// function loadComments() {
//     fetch('load_comments.php')
//     .then(response => response.json())
//     .then(data => {
//         const commentsDiv = document.getElementById('comments');
//         commentsDiv.innerHTML = '';
//         data.comments.forEach(comment => {
//             const commentElement = document.createElement('div');
//             commentElement.textContent = comment;
//             commentsDiv.appendChild(commentElement);
//         });
//     });
// }

function loadComments() {
    fetch('load_comments.php')
    .then(response => response.json())
    .then(data => {
        const commentsDiv = document.getElementById('comments');
        commentsDiv.innerHTML = '';
        data.comments.forEach(comment => {
            const commentElement = document.createElement('div');
            commentElement.classList.add('comment');
            commentElement.innerHTML = `<p class="name">${comment.wname}: ${comment.wcomments}</p>`;
            commentsDiv.appendChild(commentElement);
        });
    });
}

document.addEventListener('DOMContentLoaded', loadComments);

document.getElementById('waitlistForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('submit_form.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Thank you for joining the waitlist!');
            closeModal();
            loadComments();
        } else {
            alert(data.message);
        }
    });
});

// Function to load the high-resolution image
function loadHighResBackground() {
    const backgroundElement = document.querySelector('.background');
    const highResImage = new Image();
    highResImage.src = '/media/person-wearing-futuristic-virtual-reality-glasses-gaming.jpg'; // High-res image path
    highResImage.onload = () => {
        backgroundElement.classList.add('high-res-background');
    };
}

// Load high-resolution image after window load
window.onload = loadHighResBackground;
