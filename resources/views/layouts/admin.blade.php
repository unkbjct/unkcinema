@extends('layouts.main')

@section('main')
    <div class="container">
        <div class="card card-body bg-dark text-white">
            <div>
                <a href="{{ route('admin.contents') }}"
                    class="btn btn-outline-danger @if (str_contains(Request::route()->getName(), 'contents')) active @endif">Контент</a>
                <a href="{{ route('admin.types') }}"
                    class="btn btn-outline-danger @if (str_contains(Request::route()->getName(), 'types')) active @endif">Виды</a>
                <a href="{{ route('admin.categories') }}"
                    class="btn btn-outline-danger @if (str_contains(Request::route()->getName(), 'categories')) active @endif">Жанры</a>
                {{-- <a href="{{route('admin')}}" class="btn btn-outline-danger">Жанры</a> --}}
                {{-- <a href="{{route('admin')}}" class="btn btn-outline-danger">Пользователи</a> --}}
            </div>
        </div>
    </div>

    @yield('admin')
@endsection
