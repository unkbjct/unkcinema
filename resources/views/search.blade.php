@extends('layouts.main')

@section('title')
    Поиск
@endsection

@section('components')
    <link rel="stylesheet" href="{{ asset('public/css/search.css') }}">
@endsection

@section('main')
    <div class="container">
        <form method="GET" action="{{ route('search') }}" class="card border-0 bg-dark text-white">
            <div class="d-flex">
                <div class="card-body d-flex align-items-center">
                    <div>
                        <input name="title" value="{{ old('title') }}" type="text" class="form-control"
                            placeholder="Название">
                    </div>
                </div>
                <button class="btn btn-success ms-auto">
                    Применить
                </button>
                <button type="button" class="btn btn-danger ms-auto" data-bs-toggle="collapse"
                    data-bs-target="#collapseExample">
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
                                @foreach ($typesList as $type)
                                    <div class="form-check form-switch">
                                        <input name="types[]" @if (old('types') && in_array($type->id, old('types'))) checked @endif
                                            value="{{ $type->id }}" class="form-check-input" type="checkbox"
                                            id="type-{{ $type->id }}">
                                        <label class="form-check-label"
                                            for="type-{{ $type->id }}">{{ $type->title }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-body bg-dark">
                                <div class="fw-semibold mb-4">
                                    Жанр
                                </div>
                                @foreach ($categoriesList as $category)
                                    <div class="form-check form-switch">
                                        <input name="categories[]" @if (old('categories') && in_array($category->id, old('categories'))) checked @endif
                                            value="{{ $category->id }}" class="form-check-input" type="checkbox"
                                            id="category-{{ $category->id }}">
                                        <label class="form-check-label"
                                            for="category-{{ $category->id }}">{{ $category->title }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-body bg-dark">
                                <div class="fw-semibold mb-4">
                                    Доп. фильтры
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="add[country]"
                                        @if (old('add') && isset(old('add')['country'])) value="{{ old('add')['country'] }}" @endif
                                        class="form-control form-control-sm" placeholder="Страна">
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="add[year]"
                                        @if (old('add') && isset(old('add')['year'])) value="{{ old('add')['year'] }}" @endif
                                        class="form-control form-control-sm" placeholder="Год">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="mt-4">
            <div class="row gy-4">
                @forelse ($contentsList as $c)
                    <div class="col-lg-3">
                        <div class="custom-card">
                            <a href="{{ route('content', ['content' => $c->id]) }}">
                                <div class="custom-card_image">
                                    <img src="{{ asset($c->image) }}" alt="">
                                </div>
                            </a>
                            <h5>{{ $c->title_rus }}</h5>
                            <div class="description">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Obcaecati quaerat optio repellat
                                temporibus architecto cumque ipsam hic, totam accusamus eius ea officiis itaque doloremque
                                a, adipisci incidunt illum natus. Unde.
                            </div>
                            <div class="text-secondary small">Длительность:
                                @if ($c->duration >= 3600)
                                    {{ gmdate('H:i:s', $c->duration) }}
                                @else
                                    {{ gmdate('i:s', $c->duration) }}
                                @endif
                            </div>
                            <div class="text-secondary small">Автор: <a href="#">unkbjct</a></div>
                        </div>
                    </div>
                @empty
                    <div class="py-5 text-center text-muted fw-bold fs-3">
                        <div class="mb-5">По заданным фильтрам ничего не найдено</div>
                        <a href="{{ route('search') }}" class="btn btn-outline-dark btn-lg">Сбросить фильтры</a>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
@endsection
