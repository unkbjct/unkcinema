@extends('layouts.admin')

@section('title')
    Весь контент
@endsection

@section('admin')
    <div class="container">
        <div class="card card-body border border-danger">
            <div class="d-flex align-items-center mb-5">
                <div class="display-5">Весь контент</div>
                <div class="ms-auto">
                    <a href="{{ route('admin.contents.create') }}" class="btn btn-dark">Добавить новый</a>
                </div>
            </div>
            <div>
                <form method="GET" action="{{route('admin.contents')}}" class="row gy-4">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <input name="title" type="text" value="{{old('title')}}" class="form-control" placeholder="Название" id="title_rus">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div>
                            <button class="btn btn-danger">Применить</button>
                            <button class="btn btn-dark">Сбросить</button>
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                </form>
            </div>
            <div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Название</th>
                            <th scope="col">Тип</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contents as $content)
                            <tr>
                                <th scope="row">1</th>
                                <td>{{ $content->title_rus }}</td>
                                <td>{{ $content->type }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.contents.information', ['content' => $content->id]) }}"
                                            class="btn btn-danger btn-sm ms-auto">Подробнее</a>
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
