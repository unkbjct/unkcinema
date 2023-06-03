@extends('layouts.main')

@if (Auth::check() && Auth::user()->id == $user->id)
    @section('scripts')
        <script>
            document.getElementById("avatar").addEventListener("change", function() {
                // alert(123);
                this.parentElement.submit();
            })

            document.getElementById("cover").addEventListener("change", function() {
                // alert(123);
                this.parentElement.submit();
            })
        </script>
    @endsection
@endif

@section('main')
    <div class="container">
        <div class="bg-dark text-white mb-5">
            <div class="user-cover position-relative"
                @if ($user->cover) style="height: 240px; background-image: url({{ asset($user->cover) }}); background-size: cover; background-position:0 -60px;"
                @else
                style="height: 240px; background: linear-gradient(126deg, #e66465, #9198e5);" @endif>
                @if (Auth::check() && Auth::user()->id == $user->id)
                    <form action="{{ route('user.edit.cover') }}" method="POST" enctype="multipart/form-data"
                        class="edit-cover position-absolute end-0 top-0 p-4">
                        @csrf
                        <label for="cover" class="btn btn-danger btn-sm shadow-lg">Изменить</label>
                        <input type="file" name="cover" id="cover" class="d-none">
                    </form>
                @endif
            </div>
            <div class="d-flex px-5 pt-3">
                <form action="{{ route('user.edit.avatar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label class="me-4 rounded-circle" for="avatar" style="translate: 0 -80px; cursor: pointer">
                        @if ($user->img)
                            <div class="rounded-circle border border-2 border-danger bg-secondary"
                                style="height: 140px; width: 140px; background-image: url({{ asset($user->img) }}); background-size: cover; background-position:center;">
                            </div>
                        @else
                            <div class="rounded-circle border border-2 border-danger bg-secondary p-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100px" height="100px" fill="currentColor"
                                    class="bi bi-person" viewBox="0 0 16 16">
                                    <path
                                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                                </svg>
                            </div>
                        @endif
                    </label>
                    @if (Auth::check() && Auth::user()->id == $user->id)
                        <input type="file" name="avatar" id="avatar" class="d-none">
                    @endif
                </form>
                <div>
                    <h4>{{ $user->login }}</h4>
                    <div class="text-white-50">
                        <div>
                            <small>Дата регистрации: {{ date_format($user->created_at, 'Y.m.d') }}</small>
                        </div>
                        <div>
                            <small>Количество обсуждений: {{ $comments->count() }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h4 class="mb-4">Обсуждения</h4>
            <div>
                @forelse ($comments as $comment)
                    <div class="card card-body mb-4 bg-dark text-white">
                        <div class="mb-3 d-flex justify-content-between flex-wrap">
                            <span>
                                <span class="fw-semibold">{{ $user->login }}</span>
                                <small class="text-white-50">
                                    @if ($comment->parent_id)
                                        продолжил/а обсуждение
                                    @else
                                        обсудил/а
                                    @endif
                                </small>
                                <a href="{{ route('content', ['content' => $comment->content_id]) }}"><span
                                        class="fw-semibold">{{ $comment->title }}</span></a>
                            </span>
                            <small class="text-white-50">{{ date_format($comment->created_at, 'Y.m.d') }}</small>
                        </div>
                        <div>
                            {{ $comment->message }}
                        </div>
                    </div>
                @empty
                    <div class="p-5 d-flex justify-content-center">
                        <h6>Пользователь еще ничего не обсудил</h6>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
