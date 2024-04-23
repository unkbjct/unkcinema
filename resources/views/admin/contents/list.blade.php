@extends('layouts.admin')

@section('title')
    Все сюжеты
@endsection

@section('admin')
    <div class="container">
        <div class="card card-body border border-danger">
            <div class="d-flex align-items-center mb-5">
                <div class="display-5">Все сюжеты</div>
                <div class="ms-auto">
                    <a href="{{ route('admin.contents.create') }}" class="btn btn-dark">Добавить новый</a>
                </div>
            </div>
            <div>
                <form method="GET" action="{{ route('admin.contents') }}" class="row gy-4">
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <input name="title" type="text" value="{{ old('title') }}" class="form-control"
                                placeholder="Название" id="title_rus">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-select" name="type" id="type">
                            <option selected value="">Категория(все)</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" @if (old('type') == $type->id) selected @endif>
                                    {{ $type->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <div class="dropdown">
                            <button class="btn btn-outline-danger dropdown-toggle" type="button" data-bs-auto-close="false"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Теги @if (!!old('categories'))
                                    ({{ sizeof(old('categories')) }})
                                @endif
                            </button>
                            <ul class="dropdown-menu">
                                @foreach ($categories as $cat)
                                    <label class="dropdown-item" for="category-{{ $cat->id }}">
                                        <div class=" form-check form-switch">
                                            <input type="checkbox" @if (!!old('categories') && in_array($cat->id, old('categories'))) checked @endif
                                                class="form-check-input" name="categories[]" value="{{ $cat->id }}"
                                                id="category-{{ $cat->id }}">
                                            <span class="form-check-label">{{ $cat->title }}
                                            </span>
                                        </div>
                                    </label>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div>
                            <button class="btn btn-danger">Применить</button>
                            <a href="{{ route('admin.contents') }}" class="btn btn-dark">Сбросить</a>
                        </div>
                    </div>
                </form>
            </div>
            <div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Название</th>
                            <th scope="col">Тип</th>
                            <th scope="col">Длительность <br> (в секундах)</th>
                            <th scope="col">Формат</th>
                            <th scope="col">Дата созднания</th>
                            <th scope="col">Дата последнего обнавления</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contents as $content)
                            <tr>
                                <th scope="row">1</th>
                                <td>{{ $content->title_rus }}</td>
                                <td><a
                                        href="{{ route('admin.types.information', ['type' => $content->typeId]) }}">{{ $content->type }}</a>
                                </td>
                                <td>{{ $content->duration }}</td>
                                <td>{{ $content->extension }}</td>
                                <td>{{ $content->created_at }}</td>
                                <td>{{ $content->updated_at }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.contents.information', ['content' => $content->id]) }}"
                                            class="btn btn-danger btn-sm ms-auto">Подробнее</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <th colspan="10">
                                    <div class="p-3 text-center text-muted">
                                        По заданным фильтрам ничего не найдено!
                                    </div>
                                </th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
