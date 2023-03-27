@extends('layouts.main')

@section('main')
    <div class="container">
        <section>
            <div class="mb-4">
                <h1>Рандомайзер фильма</h1>
                <div>Если не знаешь что посмотреть, мы поможем</div>
            </div>
            <form method="GET" action="{{ route('random') }}" class="card border-0 bg-dark text-white">
                <div class="d-flex">
                    <div class="card-body d-flex align-items-center">
                        <div class="mx-auto">
                            <button class="btn btn-success ms-auto">
                                Найти
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="collapse"
                                data-bs-target="#collapseExample">
                                фильтры
                            </button>
                        </div>
                    </div>
                </div>
                <div class="collapse show" id="collapseExample">
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
        </section>
        <section id="information" class="mt-5">
            <div class="card border-0">
                <div class="card-body bg-dark text-white">
                    <div class="row gy-4">
                        @if ($content)
                            <div class="col-md-2">
                                <img class="w-100" src="{{ asset($content->image) }}" alt="">
                            </div>
                            <div class="col-md-5">
                                <div class="h-100 d-flex flex-column">
                                    <div class="my-auto">
                                        <div class="display-2 mb-3">{{ $content->title_rus }}</div>
                                        @if (Cookie::has('continue'))
                                            <div class="display-2 mb-3">asdf</div>
                                        @endif
                                        <div class="mb-3 fw-semibold">{{ $content->type->title }}, {{ $content->year }}+
                                        </div>
                                        <div class="d-flex flex-wrap mb-3">
                                            @foreach ($content->categories as $category)
                                                <span
                                                    class="badge text-bg-danger p-2 rounded-0 me-2">{{ $category->title }}</span>
                                            @endforeach
                                        </div>
                                        <a href="{{ route('content', ['content' => $content->id]) }}"
                                            class="btn btn-light">Смотреть</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="h-100 d-flex flex-column">
                                    <div class="my-auto">
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
                        @else
                            <div class="col-md-12">
                                <div class="text-white-50 py-5 text-center fs-6">
                                    К сожалению ничего не найдено
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
