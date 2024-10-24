<div class="comment my-4 shadow-sm rounded">
    <div class="comment-box"
        style="background-color: #f9f9f9; padding: 15px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <div class="d-flex align-items-center">
                <img class="rounded-circle me-2"
                    src="https://i.pinimg.com/originals/e4/ce/db/e4cedb03bd1fda8d296b905852f3a3d5.jpg" alt="Profile"
                    width="40" />
                <div>
                    <strong>{{ $comment->account->name }}</strong>
                    <small class="text-muted">{{ $comment->created_at->format('d/m/Y H:i') }}</small>
                </div>
            </div>
        </div>
        <p class="text-secondary mb-1" style="font-size: 1rem; line-height: 1.5;">{{ $comment->content }}</p>

        <!-- Nút Reply -->
        <button class="btn btn-link p-0 text-primary" data-bs-toggle="collapse"
            data-bs-target="#replyForm{{ $comment->id }}">Trả lời</button>

        <!-- Form trả lời bình luận -->
        <div class="collapse mt-2" id="replyForm{{ $comment->id }}">
            <form class="replyForm" data-comment-id="{{ $comment->id }}">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                <textarea class="form-control" rows="3" name="content" placeholder="Viết trả lời..." required
                    style="border-radius: 0.5rem;"></textarea>
                <button type="submit" class="btn btn-primary mt-2 reply-button" style="border-radius: 0.5rem;">Trả
                    lời</button>
                <!-- Loading spinner -->
                <div id="loadingSpinner" class="spinner-border text-primary mt-2 d-none" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </form>
        </div>

        <!-- Replies Section -->
        <div id="replies{{ $comment->id }}" class="mt-2" style="display: none;">
            @foreach ($comment->replies->reverse() as $reply)
                @include('hackathon.partials.comment', ['comment' => $reply, 'level' => 1])
            @endforeach
        </div>

        <!-- Nút xem/ẩn replies -->
        @if ($comment->replies->count() > 0)
            <button class="btn btn-link toggle-replies text-muted" data-comment-id="{{ $comment->id }}"
                style="padding: 0;">
                Xem trả lời
            </button>
        @endif
    </div>
</div>
