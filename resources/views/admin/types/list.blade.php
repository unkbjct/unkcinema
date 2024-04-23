@extends('layouts.admin')

@section('title')
    Категории сюжетов
@endsection

@section('components')
    <script src="{{ asset('public/js/types.js') }}"></script>
@endsection

@section('admin')
    <div class="container">
        <div class="card card-body border border-danger">
            <div class="d-flex align-items-center mb-2">
                <div class="display-5">Категории</div>
                <div class="ms-auto">
                    <a href="{{ route('admin.contents.create') }}" class="btn btn-dark" data-bs-toggle="collapse"
                        data-bs-target="#collapseCreate">Добавить новую категорию</a>
                </div>
            </div>
            <div class="small d-flex align-items-center gap-2 mb-4">
                <svg width="20" height="20" fill="currentColor" class="bi bi-exclamation-octagon"
                    viewBox="0 0 16 16">
                    <path
                        d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1z" />
                    <path
                        d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                </svg>
                <span>При удалении категории также удаляются все сюжеты, входившие в эту категорию</span>
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
                            <a href="{{ route('admin.types') }}" class="btn btn-dark">Сбросить</a>
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
