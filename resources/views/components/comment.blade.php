<div id="comment-{{ $comment->id }}"
    class="card mb-3 @if ($comment->parent_id) border-danger @else border-dark @endif">
    <div class="card-body">
        <div class="d-flex align-items-center flex-wrap">
            <div class="d-flex align-items-center">
                <a href="{{ route('user.profile', ['login' => $comment->user->login]) }}">
                    @if (!$comment->user->img)
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                            class="bi bi-person-circle me-3" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path fill-rule="evenodd"
                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                        </svg>
                    @else
                        <img class="rounded-circle me-3" src="{{ asset($comment->user->img) }}"
                            style="width: 50px; height: 50px" alt="">
                    @endif
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
