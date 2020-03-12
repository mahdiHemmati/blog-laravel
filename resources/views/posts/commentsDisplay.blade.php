@foreach($comments as $comment)
    <div class="display-comment p-1 mb-2"
         @if($comment->parent_id != null)
         style="margin-left:40px ; border: hidden; font-style: italic"
            @endif
    >
        <strong >{{ $comment->user->name }}</strong>
        <p>{{ $comment->body }}</p>
        <a href="" id="reply"></a>
        @include('posts.commentsDisplay', ['comments' => $comment->replies])
        @if($comment->parent_id == null)
        <form method="post" action="{{ route('comments.store') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="body1" class="form-control" />
                <input type="hidden" name="post_id" value="{{ $post_id }}" />
                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-warning" value="Reply" />
            </div>
        </form>
        @endif

    </div>
@endforeach