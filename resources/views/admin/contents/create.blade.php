@extends('layouts.admin')

@section('title')
    Весь контент
@endsection

@section('components')
    <link rel="stylesheet" href="{{ asset('public/css/contents.css') }}">
    <script src="{{ asset('public/js/contents.js') }}"></script>
@endsection

@section('admin')
    <div class="container">
        <div class="card card-body border border-danger">
            <div class="mb-5">
                <div class="display-5 mb-3">Создание нового контента</div>
                <a href="{{ route('admin.contents') }}" class="btn btn-outline-dark">Вернуться назад</a>
            </div>
            <div class="div">
                <form id="form-create" action="{{ route('core.admin.contents.create') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row gy-4">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="title_rus" class="form-label">Название на русском</label>
                                <input required type="text" class="form-control" name="title_rus" id="title_rus">
                                <div class="form-text">Обязательное</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="title_eng" class="form-label">Название на английском</label>
                                <input required type="text" class="form-control" name="title_eng" id="title_eng">
                                <div class="form-text">Или транскрипция, обязательное.</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="description" class="form-label">Описание</label>
                                <textarea name="description" id="description" class="form-control"></textarea>
                                <div class="form-text">Не обязательное, максимум 10 000 символов.</div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="mb-3">
                                <label for="year" class="form-label">Возраст просмотра</label>
                                <input required type="number" class="form-control" name="year" id="year">
                                <div class="form-text">Цифра, обязательное.</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="image" class="form-label">Изображение</label>
                                <input required type="file" class="form-control" name="image" id="image">
                                <div class="form-text">Обязательное.</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="type" class="form-label">Вид контента</label>
                                <select required class="form-select" name="type" id="type"
                                    aria-label="Default select example">
                                    <option selected></option>
                                    @foreach ($types as $type)
                                        <option data-is-one-video="{{ $type->is_one_video }}"
                                            data-attributes="{{ $type->attributes }}" value="{{ $type->id }}">
                                            {{ $type->title }}</option>
                                    @endforeach
                                </select>
                                <div class="form-text">Обязательное, если нужного вида нет, добавьте его <a
                                        href="{{ route('admin.types') }}">здесь</a></div>
                            </div>
                            <div id="attributes-list">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="category" class="form-label">Жанры / Теги</label>
                                <div class="input-group">
                                    <select class="form-select" name="category" id="value-category"
                                        aria-label="Default select example">
                                        <option selected></option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-dark" id="add-category">Добавить</button>
                                </div>
                                <div class="form-text">Не обязательное, если нужного жанра нет, добавьте его <a
                                        href="{{ route('admin.categories') }}">здесь</a></div>
                            </div>
                            <div id="categories-list" class="d-flex flex-wrap">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3 d-flex">
                            <button class="btn btn-outline-danger" disabled>Добавить видео можно после создания
                                контента</button>
                            <button class="btn ms-auto btn-danger">Создать контент</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
