<!-- comments.blade.php -->
<?php $totalComments = DB::table('comments')->count('id'); ?>
<section class="comment-section mt-5" style="padding-bottom: 5%">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">

            <h2 class="text-dark fw-bold">Thảo luận ({{ $totalComments }})</h2>
        </div>

        <!-- Form gửi bình luận -->
        <form id="commentForm" class="mb-4" method="POST">
            @csrf
            <div class="form-group mb-3">
                <textarea id="comment" rows="6" class="form-control" placeholder="Viết bình luận..." required
                    style="border-radius: 0.5rem" name="content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-lg submit-comment" style="border-radius: 0.5rem">Bình
                luận</button>

            <!-- Loading spinner -->
            <div id="loadingSpinner" class="spinner-border text-primary mt-2 d-none" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </form>


        <div class="showComment">
            <!-- Hiển thị bình luận cấp 1 -->
            @foreach ($comments as $comment)
                @include('hackathon.partials.comment', ['comment' => $comment, 'level' => 0])
            @endforeach
        </div>

        <!-- Nút xem thêm bình luận -->
        @if (count($comments) == 5)
            <div class="text-center">
                <button id="loadMoreComments" class="btn btn-secondary mt-3">Xem thêm</button>

                <!-- Loading spinner khi tải thêm bình luận -->
                <div id="loadMoreSpinner" class="spinner-border text-primary mt-2 d-none" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        @endif
    </div>
</section>
