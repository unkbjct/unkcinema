@extends('layouts.main')

@section('main')
    <div class="container">
        <div class="card card-body bg-dark text-white">
            <div>
                <a href="{{ route('admin.contents') }}"
                    class="btn btn-outline-danger @if (str_contains(Request::route()->getName(), 'contents')) active @endif">Сюжет</a>
                <a href="{{ route('admin.types') }}"
                    class="btn btn-outline-danger @if (str_contains(Request::route()->getName(), 'types')) active @endif">Категории</a>
                <a href="{{ route('admin.categories') }}"
                    class="btn btn-outline-danger @if (str_contains(Request::route()->getName(), 'categories')) active @endif">Теги</a>
                {{-- <a href="{{route('admin')}}" class="btn btn-outline-danger">Теги</a> --}}
                <a href="{{ route('admin.users') }}"
                    class="btn btn-outline-danger @if (str_contains(Request::route()->getName(), 'user')) active @endif">Пользователи</a>
            </div>
        </div>
    </div>

    @yield('admin')
@endsection
