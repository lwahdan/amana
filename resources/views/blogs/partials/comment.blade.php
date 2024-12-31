<div class="comment-list">
    <div class="single-comment justify-content-between d-flex">
        <div class="user justify-content-between d-flex">
            <div class="desc">
                <h5 class="name_comment">
                    {{ $comment->user->name }}
                </h5>
                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <p class="comment">
                            {{ $comment->comment }}
                        </p>
                    </div>
                    <p class="date">
                        {{ $comment->created_at->format('F d, Y \\a\\t h:i A') }}
                    </p>
                </div>
                <form method="POST" action="{{ route('comments.reply', $comment->id) }}" class="d-flex">
                    @csrf
                    <textarea name="comment" class="form-control mb-2 col-11" cols="30" rows="1" placeholder="Write your reply..." required></textarea>
                    <button type="submit" class="btn btn-reply text-uppercase col-1"><i class="fa-solid fa-reply"></i></button>
                </form>

                <!-- Display Replies -->
                @if ($comment->replies->count())
                    <div class="replies ml-4 mt-4">
                        @foreach ($comment->replies as $reply)
                            @include('blogs.partials.comment', ['comment' => $reply])
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
