<div id="comment-{{ $comment->id }}"
    class="card mb-3 @if ($comment->parent_id) border-danger @else border-dark @endif">
    <div class="card-body">
        <div class="d-flex align-items-center flex-wrap">
            <div class="d-flex align-items-center">
                <a href="{{ route('user.profile', ['login' => $comment->user->login]) }}">
                    <img class="rounded-circle me-3" src="{{ asset($comment->user->img) }}"
                        style="width: 50px; height: 50px" alt="">
                </a>
                <div class="fw-semibold">{{ $comment->user->login }}</div>
            </div>
            @if ($comment->parent_id)
                <div class="font-monospace ms-3">ответил/а</div>
                <a href="#comment-{{ $comment->parent_id }}"
                    class="ms-3 fw-semibold">{{ $comment->parent_user->login }}</a>
            @endif
            @auth
                <button class="ms-auto btn-answer btn btn-sm btn-outline-danger" data-parent-id="{{ $comment->id }}"
                    data-parent-login="{{ $comment->user->login }}">Обсудить</button>
            @endauth
            <div class="@if (Auth::check()) ms-4 @else ms-auto @endif text-muted">
                {{ date('h:i, d.m.Y', strtotime($comment->created_at)) }}</div>
        </div>
        <div class="card-body">
            {!! str_replace("\n", '<br>', $comment->message) !!}
        </div>
    </div>
</div>
<div class="">
    @each('components.comment', $comment->children, 'comment')
</div>
