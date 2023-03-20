<div class="card mb-3 @if ($comment->parent_id) border-danger @else border-dark @endif">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="fw-semibold">{{ $comment->user->login }}</div>
            @if ($comment->parent_id)
                <div class="font-monospace ms-3">ответил</div>
                <div class="ms-3 fw-semibold">{{ $comment->parent_user->login }}</div>
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
<div class="ms-5">
    @each('components.comment', $comment->children, 'comment')
</div>
