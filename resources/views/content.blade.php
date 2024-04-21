@extends('layouts.main')

@section('title')
    {{ $content->title_rus }}
@endsection

@section('components')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <link rel="stylesheet" href="{{ asset('public/css/plugin.css') }}"> --}}
    <script src="{{ asset('public/js/playerjs.js') }}"></script>
    <script src="{{ asset('public/js/content.js') }}"></script>
@endsection

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <section id="information" class="mb-5">
                    <div class="card border-0">
                        <div class="card-body bg-dark text-white position-relative">
                            <div class="position-absolute end-0 top-0 p-4">
                                <form action="{{ route('core.user.bookmarks') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="content" value="{{ $content->id }}">
                                    <div class="btn-mark @if (Cookie::has('bookmarks') && in_array($content->id, json_decode(Cookie::get('bookmarks')))) active @endif" id="btn-mark">
                                        <svg class="bookmark" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="currentColor" class="bi bi-bookmark" viewBox="0 0 16 16">
                                            <path
                                                d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                                        </svg>
                                        <svg class="bookmark-fill" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="currentColor" class="bi bi-bookmark-fill"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2z" />
                                        </svg>
                                    </div>
                                </form>
                            </div>
                            <div class="row gy-4 mb-4">
                                <div class="col-md-12">
                                    <img class="w-100" src="{{ asset($content->image) }}" alt="">
                                </div>
                                @if (Auth::check() && Auth::user()->role === 'ADMIN')
                                    <div class="d-flex flex-wrap gap-1">
                                        @if ($content->published)
                                            <button class="btn btn-sm btn-success disabled">
                                                <span>Сюжет доступен для обычных пользователей</span>
                                            </button>
                                        @else
                                            <button class="btn btn-sm btn-info disabled">
                                                <span>Сюжет скрыт для обычных пользователей</span>
                                            </button>
                                        @endif
                                        <a href="{{ route('admin.contents.information', ['content' => $content->id]) }}"
                                            class="btn btn-danger btn-sm">изменить</a>
                                    </div>
                                @endif

                                <div class="col-md-12">
                                    <div>
                                        <h1 class="mb-3">{{ $content->title_rus }}</h1>
                                        <div class="mb-3 fw-semibold">{{ $content->type->title }}</div>
                                        <div class="mb-2">{{ $content->description }}</div>
                                        <div class="d-flex flex-wrap mb-4 gap-2">
                                            @foreach ($content->categories as $category)
                                                <span class="badge bg-danger">{{ $category->title }}</span>
                                            @endforeach
                                        </div>
                                        <div>
                                            <div class="d-flex border-start border-danger border-2 p-2 fit-content fs-6">
                                                <div class="me-3">Длительность:</div>
                                                <div>
                                                    @if ($content->video->duration >= 3600)
                                                        {{ gmdate('H:i:s', $content->video->duration) }}
                                                    @else
                                                        {{ gmdate('i:s', $content->video->duration) }}
                                                    @endif
                                                </div>
                                            </div>
                                            @foreach ($content->attributes as $attribute)
                                                <div
                                                    class="d-flex border-start border-danger border-2 p-2 fit-content fs-6">
                                                    <div class="me-3">{{ $attribute->name }}:</div>
                                                    <div>{{ $attribute->value }}</div>
                                                </div>
                                            @endforeach
                                            <div class="d-flex border-start border-danger border-2 p-2 fit-content fs-6">
                                                <div class="me-3">Создан:</div>
                                                <div>{{ date('d.m.Y, H:m', strtotime($content->created_at)) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-lg-8">
                <section id="content" class="mb-5">
                    <div class="mb-5">
                        <div id="player"></div>
                        <script>
                            var player = new Playerjs({
                                id: "player",
                                poster: "{{ asset($content->image) }}",
                                file: "{{ asset($content->video->url) }}"
                            });
                        </script>
                    </div>
                    <section>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2>Обсуждение</h2>
                            <div>
                                @if (Auth::check())
                                    <button id="add-comment" class="btn btn-outline-dark">Обсудить</button>
                                @else
                                    <button disabled class="btn btn-outline-dark">Авторизуйтесь чтобы вы могли обсудить со
                                        всеми</button>
                                @endif
                            </div>
                        </div>
                        @auth
                            <div id="add-comment-form" class="visually-hidden">
                                <form class="card card-body border-dark position-relative mb-4" method="POST"
                                    action="{{ route('core.content.comment.create', ['content' => $content->id]) }}">
                                    @csrf
                                    <div class=" position-absolute top-0 end-0 pt-2 pe-2">
                                        <button type="button" class="btn-close" id="btn-close-form"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="mb-3 visually-hidden" id="isAnswer">
                                        <div>Ответ для <span id="answer-login" class="fw-semibold">remover</span></div>
                                        <input type="hidden" id="parent-id" name="parent_id" class="parent-id">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Никнейм</label>
                                        <input type="text" value="{{ Auth::user()->login }}" disabled class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Ваша мысль</label>
                                        <textarea name="message" id="message" rows="5" class="form-control" required></textarea>
                                    </div>
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-danger ms-auto">Добавить</button>
                                    </div>
                                </form>
                            </div>
                        @endauth
                        @if ($comments->isNotEmpty())
                            @each('components.comment', $comments, 'comment')
                        @else
                            <div class="text-center text-muted fs-4 fw-semibold">Никто еще не обсудил данное произведение,
                                будьте
                                первыми</div>
                        @endif
                    </section>
                </section>
            </div>
        </div>
    </div>
@endsection
