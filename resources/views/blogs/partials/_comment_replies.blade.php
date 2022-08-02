<div class="ml-4">
    @foreach ($comments as $comment)
    <div class="mb-4">
        <div>
            <strong>{{$comment->user->name}}</strong>
            <small class="mb-2">
                {{$comment->created_at->diffForHumans()}}
            </small>
            <small class="mb-2">
                @if(auth()->id() == $comment->user_id)
                <form class="d-inline" action="{{ route('blogs.comment.destroy',compact('blog','comment')) }}"
                    method="post">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-outline-danger btn-sm">Delete</button>
                </form>
                @endif
            </small>
        </div>
        <div>
            {!! $comment->comment !!}
        </div>
        @auth
        <form class="mt-2 mb-3" action="{{route('blogs.comment.reply.store', $blog)}}" method="post">
            @csrf
            <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
            <div class="row">
                <div class="col-11">
                    <textarea class="form-control" name="comment" rows="1" placeholder="reply"></textarea>
                </div>
                <div class="col-1">
                    <button type="submit" class="btn btn-primary">Reply</button>
                </div>
            </div>
        </form>
        @endauth
    </div>
    @endforeach
</div>