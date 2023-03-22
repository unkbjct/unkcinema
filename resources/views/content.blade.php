@extends('layouts.main')

@section('title')
    @if ($content->type->is_one_video)
        {{ $content->title_rus }}
    @else
        {{ "{$content->title_rus}, {$content->thisSeason->number} Сезон {$content->thisEpisode->number} Серия" }}
    @endif
@endsection

@section('components')
    <link rel="stylesheet" href="{{ asset('public/css/plugin.css') }}">
    <script src="{{ asset('public/js/plugin.js') }}"></script>
    <script src="{{ asset('public/js/content.js') }}"></script>
@endsection

@section('main')
    <div class="container">
        <section id="information" class="mb-5">
            <div class="card border-0">
                <div class="card-body bg-dark text-white">
                    <div class="row gy-4 mb-4">
                        <div class="col-md-3">
                            <img class="w-100" src="{{ asset($content->image) }}" alt="">
                        </div>
                        <div class="col-md-9">
                            <div>
                                <div class="display-2 mb-3">{{ $content->title_rus }}</div>
                                <div class="mb-3 fw-semibold">{{ $content->type->title }}, {{$content->year}}+ </div>
                                <div class="d-flex flex-wrap mb-4">
                                    @foreach ($content->categories as $category)
                                        <span class="badge text-bg-danger p-2 rounded-0 me-2">{{ $category->title }}</span>
                                    @endforeach
                                </div>
                                <div class="mb-4">
                                    @foreach ($content->attributes as $attribute)
                                        <div class="d-flex border-start border-danger border-2 p-2 fit-content fs-6">
                                            <div class="me-3">{{ $attribute->name }}:</div>
                                            <div>{{ $attribute->value }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @if ($content->description)
                            <div class="col-md-12">
                                <div>{{ $content->description }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <section id="content" class="mb-5">
            @if ($content->type->is_one_video)
                <div data-src="{{ asset($content->video->url) }}" id="video-container" class="mb-5">
                </div>
            @else
                <div data-src="{{ asset($content->thisEpisode->url) }}" data-seasons="{{ $content->seasons }}"
                    data-is-serial="0" data-this-season="{{ $content->thisSeason }}"
                    data-this-episode="{{ $content->thisEpisode }}" data-next-episode="{{ $content->nextEpisode }}"
                    id="video-container" class="mb-5">
                </div>
            @endif
        </section>
        <hr>
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
                            <button type="button" class="btn-close" id="btn-close-form" aria-label="Close"></button>
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
                <div class="text-center text-muted fs-4 fw-semibold">Никто еще не обсудил данное произведение, будьте
                    первыми</div>
            @endif
        </section>
    </div>
@endsection
