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
            <div class="d-flex align-items-center mb-5">
                <div class="display-5">Категории</div>
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
                            <th scope="col">Логин</th>
                            <th scope="col">Роль</th>
                            <th scope="col">Почта</th>
                            <th scope="col">Дата регистрации</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->login }}</td>
                                <td>
                                    @if ($user->role === 'ADMIN')
                                        <span class="badge bg-danger">Администратор</span>
                                    @else
                                        <span class="badge bg-secondary">Пользователь</span>
                                    @endif
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ date('d.m.Y', strtotime($user->created_at)) }}</td>
                                <td>
                                    <div class="d-flex">
                                        @if (Auth::user()->id === $user->id)
                                            <div class="btn btn-sm btn-outline-danger disabled">Вы не можете изменить себя
                                            </div>
                                        @else
                                            <form action="{{ route('core.admin.user.set') }}"
                                                id="form-remove-{{ $user->id }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                @if ($user->role === 'ADMIN')
                                                    <input type="hidden" name="role" value="USER">
                                                    <button title="Чтобы подтвердить, удерживайте кнопку 1.5 секунд"
                                                        type="button" class="btn btn-secondary btn-sm ms-2 btn-ani-remove"
                                                        data-id="{{ $user->id }}">Разжаловать до пользователя</button>
                                                @else
                                                    <input type="hidden" name="role" value="ADMIN">
                                                    <button title="Чтобы подтвердить, удерживайте кнопку 1.5 секунд"
                                                        type="button" class="btn btn-danger btn-sm ms-2 btn-ani-remove"
                                                        data-id="{{ $user->id }}">Повысить до администратора</button>
                                                @endif
                                            </form>
                                        @endif
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
