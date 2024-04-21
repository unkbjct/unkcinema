@extends('layouts.admin')

@section('title')
    Виды произведений
@endsection

@section('components')
    <script src="{{ asset('public/js/types.js') }}"></script>
@endsection

@section('admin')
    <div class="container">
        <div class="card card-body border border-danger">
            <div class="d-flex align-items-center mb-5">
                <div class="display-5">Виды</div>
                <div class="ms-auto">
                    <a href="{{ route('admin.contents.create') }}" class="btn btn-dark" data-bs-toggle="collapse"
                        data-bs-target="#collapseCreate">Добавить новый вид</a>
                </div>
            </div>
            <div class="collapse" id="collapseCreate">
                <form method="POST" action="{{ route('core.admin.types.create') }}" class="mb-5">
                    @csrf
                    <div class="mb-3">
                        <input required type="text" class="form-control" name="title" placeholder="Название вида">
                        <div id="emailHelp" class="form-text">Уникальное</div>
                    </div>
                    <button class="btn btn-dark">Добавить</button>
                </form>
            </div>
            <div>
                <form action="{{ route('admin.types') }}" method="GET" class="row gy-4">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <input name="title" value="{{ old('title') }}" type="text" class="form-control"
                                placeholder="Название" id="title_rus">
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
                        @forelse ($types as $type)
                            <tr>
                                <th scope="row">{{ $type->id }}</th>
                                <td>{{ $type->title }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.types.information', ['type' => $type->id]) }}"
                                            class="btn btn-dark btn-sm ms-auto">Изменить</a>
                                        <form id="form-remove-{{ $type->id }}"
                                            action="{{ route('core.admin.types.remove', ['type' => $type->id]) }}"
                                            method="post">
                                            @csrf
                                            <button title="Чтобы удалить, удерживайте кнопку 1.5 секунд" type="button"
                                                class="btn btn-danger btn-sm ms-2 btn-ani-remove"
                                                data-id="{{ $type->id }}">Удалить</button>
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
