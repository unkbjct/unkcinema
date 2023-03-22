@extends('layouts.admin')

@section('title')
    Виды произведений
@endsection

@section('admin')

    <div class="container">
        <div class="card card-body border border-danger">
            <div class="d-flex align-items-center mb-5">
                <div class="display-5">Жанры контента</div>
                <div class="ms-auto">
                    <a href="{{ route('admin.contents.create') }}" class="btn btn-dark" data-bs-toggle="collapse"
                        data-bs-target="#collapseCreate">Добавить новый жанр</a>
                </div>
            </div>
            <div class="collapse" id="collapseCreate">
                <form method="POST" action="{{ route('core.admin.categories.create') }}" class="mb-5">
                    @csrf
                    <div class="mb-3">
                        <div class="input-group">
                            <input required type="text" class="form-control" name="title" placeholder="Название вида">
                            <button class="btn btn-dark">Добавить</button>
                        </div>
                        <div id="emailHelp" class="form-text">Уникальное</div>
                    </div>
                </form>
            </div>
            <div>
                <form action="{{route('admin.categories')}}" method="GET" class="row gy-4">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <input name="title" value="{{old('title')}}" type="text" class="form-control" placeholder="Название" id="title_rus">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div>
                            <button class="btn btn-danger">Применить</button>
                            <button class="btn btn-dark">Сбросить</button>
                        </div>
                    </div>
                    <div class="col-lg-4">
                    </div>
                </form>
            </div>
            <div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Название</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <th scope="row">{{ $category->id }}</th>
                                <td>{{ $category->title }}</td>
                                <td>
                                    <div class="d-flex">

                                        <form class="ms-auto" id="form-remove-{{ $category->id }}"
                                            action="{{ route('core.admin.categories.remove', ['category' => $category->id]) }}"
                                            method="post">
                                            @csrf
                                            <button title="Чтобы удалить, удерживайте кнопку 1.5 секунд" type="button"
                                                class="btn btn-danger btn-sm ms-2 btn-ani-remove"
                                                data-id="{{ $category->id }}">Удалить</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <th colspan="4">
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
