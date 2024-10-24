<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" charset="utf-8">
    <link rel="stylesheet" href="{{ asset('css/hackathon/globals.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/hackathon/styleguide.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/hackathon/style2.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/hackathon/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/hackathon/button.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/hackathon/button2.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/hackathon/buttonLogout.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/hackathon/carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/hackathon/navbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/hackathon/process.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/hackathon/team.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/hackathon/testimonials.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/hackathon/comment.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/hackathon/buttonShowFollow.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/hackathon/buttonUser.css') }}" />
    <!--Bootstrap icon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous" />
    <!--Bootstrap css v5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!--swiper-->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
</head>

<body>
    <div class="landing-page">
        @include('hackathon.partials.navbar')
        @include('hackathon.partials.header')
        @include('hackathon.partials.slider')
        @include('hackathon.partials.process')
        @include('hackathon.partials.team')
        @include('hackathon.partials.testimonials')
        @include('hackathon.partials.comments')
        @include('hackathon.partials.footer')
    </div>

    <!--Bootstrap js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!--Jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!--swiper-->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!--js base-->
    <script src="{{ asset('js/hackathon/navbar.js') }}"></script>
    <script src="{{ asset('js/hackathon/carousel.js') }}"></script>
    <script src="{{ asset('js/hackathon/process.js') }}"></script>
    <script src="{{ asset('js/hackathon/testimonials.js') }}"></script>
    <script src="{{ asset('js/hackathon/team.js') }}"></script>
    <script src="{{ asset('js/hackathon/like.js') }}"></script>
    <script src="{{ asset('js/hackathon/button.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let isSubmitting = false;
            let currentPage = 1;

            // Handle comment form submission
            $('#commentForm').on('submit', function(e) {
                e.preventDefault();

                if (isSubmitting) return;

                isSubmitting = true;
                $('#loadingSpinner').removeClass('d-none');

                $.ajax({
                    url: '{{ route('createcomment') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            $('#comment').val(''); // Clear the comment field
                            $('.showComment').prepend(response
                                .comment_html); // Prepend new comment

                            // Check for replies and add toggle button if necessary
                            const newComment = $(response.comment_html);
                            const replyCount = newComment.find('.comment-box').length;

                            if (replyCount > 0) {
                                newComment.append(
                                    '<button class="btn btn-link toggle-replies text-muted" data-comment-id="' +
                                    newComment.data('comment-id') + '">Ẩn trả lời (' +
                                    replyCount + ')</button>'
                                );
                            }
                        }
                    },
                    complete: function() {
                        isSubmitting = false;
                        $('#loadingSpinner').addClass('d-none');
                    },
                    error: function(xhr) {
                        alert('Error: ' + (xhr.responseJSON?.message ||
                            'Có lỗi xảy ra. Vui lòng thử lại.'));
                        isSubmitting = false;
                        $('#loadingSpinner').addClass('d-none');
                    }
                });
            });

            // Handle reply form submission
            $(document).on('submit', '.replyForm', function(e) {
                e.preventDefault();

                const form = $(this);
                const repliesDiv = $('#replies' + form.data('comment-id'));
                const replyButton = form.find('.reply-button');

                replyButton.prop('disabled', true); // Prevent multiple submissions

                $.ajax({
                    url: '{{ route('createcomment') }}',
                    method: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        if (response.success) {
                            form.find('textarea').val(''); // Clear the reply form
                            repliesDiv.prepend(response.comment_html); // Prepend new reply
                            repliesDiv.show();

                            // Check if a toggle button is needed and add it if it doesn't exist
                            const toggleButton = form.closest('.comment-box').find(
                                '.toggle-replies');
                            if (toggleButton.length === 0) {
                                form.closest('.comment-box').append(
                                    '<button class="btn btn-link toggle-replies text-muted" data-comment-id="' +
                                    form.data('comment-id') + '">Ẩn trả lời</button>'
                                );
                            }
                        }
                    },
                    complete: function() {
                        replyButton.prop('disabled', false); // Enable the reply button
                    },
                    error: function(xhr) {
                        alert('Error: ' + (xhr.responseJSON?.message ||
                            'Có lỗi xảy ra. Vui lòng thử lại.'));
                        replyButton.prop('disabled', false);
                    }
                });
            });

            // Toggle replies visibility
            $(document).on('click', '.toggle-replies', function(e) {
                e.preventDefault();
                const button = $(this);
                const repliesDiv = $('#replies' + button.data('comment-id'));

                repliesDiv.slideToggle('fast', function() {
                    const isVisible = repliesDiv.is(':visible');
                    button.text(isVisible ? 'Ẩn trả lời' : 'Xem trả lời');
                });
            });

            // Load more comments
            $('#loadMoreComments').on('click', function() {
                currentPage++;
                $('#loadMoreComments').prop('disabled', true);
                $('#loadMoreSpinner').removeClass('d-none');

                $.ajax({
                    url: '{{ route('getcomments') }}',
                    method: 'GET',
                    data: {
                        page: currentPage
                    },
                    success: function(response) {
                        if (response.success) {
                            $('.showComment').append(response
                                .comment_html); // Append new comments

                            if (!response.has_more) {
                                $('#loadMoreComments')
                                    .hide(); // Hide the button if no more comments
                            }
                        }
                    },
                    complete: function() {
                        $('#loadMoreComments').prop('disabled', false);
                        $('#loadMoreSpinner').addClass('d-none');
                    },
                    error: function(xhr) {
                        alert('Error: ' + (xhr.responseJSON?.message ||
                            'Có lỗi xảy ra. Vui lòng thử lại.'));
                        $('#loadMoreComments').prop('disabled', false);
                        $('#loadMoreSpinner').addClass('d-none');
                    }
                });
            });
        });
    </script>
    <script>
        if (window.history && window.history.pushState) {
            window.history.pushState(null, null, window.location.href);
            window.onpopstate = function() {
                window.history.pushState(null, null, window.location.href);
            };
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#voteButton').click(function(e) {
                e.preventDefault();
                console.log('đã thực thi ajax');
                $.ajax({
                    url: '{{ route('vote') }}', // Đường dẫn đến route Laravel
                    type: 'GET', // Loại yêu cầu
                    success: function(data) {
                        if (data.success) {
                            alert("cập nhật thành công vs Ajax");
                            $('#followers').text(data.count); // Hiển thị số lượng followers
                        } else {
                            alert(data.message); // Hiển thị thông báo nếu cần
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error); // Xử lý lỗi
                    }
                });
            });
        });
    </script>


</body>

</html>
