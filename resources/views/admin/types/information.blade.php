@extends('layouts.admin')

@section('title')
    {{ $type->title }}
@endsection

@section('components')
    <link rel="stylesheet" href="{{ asset('public/css/types.css') }}">
    <script src="{{ asset('public/js/types.js') }}"></script>
@endsection

@section('admin')
    <div class="container">
        <form method="POST" action="{{ route('core.admin.types.edit', ['type' => $type->id]) }}">
            <div class="card card-body border border-danger">
                <div class="d-flex mb-4">
                    <div class="display-5">{{ $type->title }}</div>
                </div>
                <div class="d-flex mb-4">
                    <a href="{{ route('admin.types') }}" class="btn btn-outline-dark">Вернуться назад</a>
                    <button title="Чтобы удалить, удерживайте кнопку 1.5 секунд" type="button"
                        class="btn btn-danger ms-auto btn-ani-remove" data-id="{{ $type->id }}">Удалить</button>
                    <button class="btn btn-dark ms-2">Сохранить</button>
                </div>
                <div>
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Название вада</label>
                        <input required type="text" class="form-control" id="title" value="{{ $type->title }}"
                            name="title" placeholder="Название вида">
                        <div id="emailHelp" class="form-text">Уникальное</div>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" @if ($type->is_one_video) checked @endif name="isOneVideo"
                            type="checkbox" id="is-one-video">
                        <label class="form-check-label" for="is-one-video">Данный вид имеет одно видео (Как фильм)</label>
                    </div>
                    <div class="">
                        <label for="title" class="form-label">Характеристики данного вида</label>
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" id="value-attribute"
                                    placeholder="Название характеристики">
                                <button type="button" id="add-attribute" class="btn btn-dark">Добавить</button>
                            </div>
                            <div id="emailHelp" class="form-text">Длительность/Количество серий/ и т.п.</div>
                        </div>
                        <div id="attributes-list" class="d-flex flex-wrap">
                            @foreach ($attributes as $attr)
                                <div data-bs-theme="dark" class="attributes-item bg-danger">
                                    <div class="me-4">{{ $attr->name }}</div>
                                    <input type="hidden" name="attributes[]" value="{{ $attr->name }}">
                                    <button title="Удалить" type="button" class="btn-close" aria-label="Close"></button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <form id="form-remove-{{ $type->id }}" action="{{ route('core.admin.types.remove', ['type' => $type->id]) }}"
            method="post">
            @csrf
        </form>
    </div>
@endsection
