@extends('layouts.main')

@section('title')
    Поиск
@endsection

@section('components')
    <link rel="stylesheet" href="{{ asset('public/css/search.css') }}">
@endsection

@section('main')
    <div class="container">
        <div class="card border-0 bg-dark text-white">
            <div class="d-flex">
                <div class="card-body d-flex align-items-center">
                    <div>
                        <input type="text" class="form-control" placeholder="Название">
                    </div>
                </div>
                <button class="btn btn-success ms-auto">
                    Применить
                </button>
                <button class="btn btn-danger ms-auto" data-bs-toggle="collapse" data-bs-target="#collapseExample">
                    Все фильтры
                </button>
            </div>
            <div class="collapse" id="collapseExample">
                <div class="card-body bg-danger">
                    <div class="row gy-4">
                        <div class="col-md-4">
                            <div class="card-body bg-dark">
                                <div class="fw-semibold mb-4">
                                    Категория
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Триллер</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckChecked" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Ужасы</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-body bg-dark">
                                <div class="fw-semibold mb-4">
                                    Жанр
                                </div>
                                <div class="">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Мультфильм</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Сериал</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-body bg-dark">
                                <div class="fw-semibold mb-4">
                                    Страна
                                </div>
                                <div class="">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Триллер</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Триллер</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <div class="row gy-4">
                @forelse ($contentsList as $content)
                    <div class="col-lg-2">
                        <a href="{{ route('content', ['content' => $content->id]) }}">
                            <div class="card movie-item">
                                <img src="{{ asset($content->image) }}" alt="">
                                <div class="movie-information">
                                    {{ $content->title_rus }}
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                @endforelse

            </div>
        </div>
    </div>
@endsection
