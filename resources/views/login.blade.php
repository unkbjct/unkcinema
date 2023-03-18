@extends('layouts.main')
@section('title')
    Авторизация
@endsection

@section('main')
    <div class="container">
        <div class="mx-auto p-4" style="max-width: 600px">
            <form method="POST" action="{{ route('core.personal.login') }}" class="bg-dark text-white p-5 mb-4">
                @csrf
                <h1 class="mb-4 display-5">Авторизация</h1>
                <div class="mb-3">
                    <label for="email" class="form-label">Почта</label>
                    <input type="email" value="{{ old('email') }}" name="email" class="form-control" id="email">
                </div>
                <div class="mb-3">
                    <label for="passwd" class="form-label">Пароль</label>
                    <input type="password" name="passwd" class="form-control" id="passwd">
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn btn-danger mx-auto">Войти</button>
                </div>
            </form>
            <div class="text-center">
                <p>Если у вас еще нет аккаунта, <a href="{{ route('sign-up') }}">создайте его </a>.</p>
            </div>
        </div>
    </div>
@endsection
