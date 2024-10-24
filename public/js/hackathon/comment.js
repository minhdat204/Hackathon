// function comment(id, url){
//     fetch(url, {
//         method: 'POST',
//         headers: {
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
//             'Content-Type': 'application/json'
//         },
//         body: JSON.stringify({
//             comment_id: id // Any additional data you need to send
//         })
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.success) {
//             // Insert the new comment content into the DOM
//             const commentBox = document.getElementById('comment_' + id);

//             // Create or update the comment HTML
//             const commentHtml = `
//                 <div class="comment-box" style="background-color: #f9f9f9; padding: 15px; border-radius: 8px;">
//                     <div class="d-flex justify-content-between align-items-center mb-2">
//                         <div class="d-flex align-items-center">
//                             <img class="rounded-circle me-2" src="${data.comment.avatar}" alt="Profile" width="40" />
//                             <div>
//                                 <strong>${data.comment.name}</strong>
//                                 <small class="text-muted">${data.comment.timestamp}</small>
//                             </div>
//                         </div>
//                     </div>
//                     <p class="text-secondary mb-1">${data.comment.content}</p>
//                     <button class="btn btn-link p-0 text-primary" data-bs-toggle="collapse"
//                         data-bs-target="#replyForm${data.comment.id}">Trả lời</button>
//                     <div class="collapse" id="replyForm${data.comment.id}">
//                             <form>
//                                 <input type="hidden" name="parent_id" value="${data.comment.id}">
//                                 <textarea class="form-control" rows="3" name="content" placeholder="Viết trả lời..."
//                                     style="border-radius: 0.5rem;"></textarea>
//                                 <button onclick="comment( ${data.comment.id}, '{{ route('createcomment') }}')" type="button"
//                                     class="btn btn-primary mt-2" style="border-radius: 0.5rem;">Trả lời</button>
//                             </form>
//                     </div>
//                 </div>`;

//             // Insert the updated comment HTML into the DOM
//             commentBox.innerHTML = commentHtml;
//         } else {
//             console.error('Failed to retrieve comment data:', data.error);
//         }
//     })
//     .catch(error => console.error('Error:', error));
// }



// Submit comment/reply via AJAX
function submitComment(commentId, url) {
    const content = document.querySelector(`#replyForm${commentId} textarea`).value;

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            parent_id: commentId,
            content: content
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Append the new comment to the reply list
            const repliesContainer = document.querySelector(`#replies_${commentId}`);
            repliesContainer.innerHTML += data.replyHtml;
            repliesContainer.style.display = 'block'; // Show replies
        } else {
            console.error('Error posting comment:', data.error);
        }
    })
    .catch(error => console.error('Error:', error));
}

// Load replies via AJAX
function loadReplies(commentId, url) {
    fetch(url, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const repliesContainer = document.querySelector(`#replies_${commentId}`);
            repliesContainer.innerHTML = data.repliesHtml;
            repliesContainer.style.display = 'block'; // Show replies
        } else {
            console.error('Error loading replies:', data.error);
        }
    })
    .catch(error => console.error('Error:', error));
}
