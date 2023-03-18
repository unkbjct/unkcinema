@extends('layouts.main')
@section('title')
    Регистрация
@endsection

@section('main')
    <div class="container">
        <div class="mx-auto p-4 rounded-1" style="max-width: 600px">
            <form method="POST" class="bg-dark text-white p-5 mb-4" action="{{ route('core.personal.sign-up') }}">
                @csrf
                <h1 class="mb-4 display-5">Регистрация</h1>
                <div class="mb-3">
                    <label for="email" class="form-label">Почта</label>
                    <input type="email" value="{{ old('email') }}" name="email" class="form-control" id="email">
                </div>
                <div class="mb-3">
                    <label for="login" class="form-label">Логин</label>
                    <input type="text" value="{{ old('login') }}" name="login" class="form-control" id="login">
                </div>
                <div class="mb-3">
                    <label for="passwd" class="form-label">Пароль</label>
                    <input type="password" name="passwd" class="form-control" id="passwd">
                </div>
                <div class="mb-3">
                    <label for="confirmPasswd" class="form-label">Подтверждение пароля</label>
                    <input type="password" name="confirmPasswd" class="form-control" id="confirmPasswd">
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn btn-danger mx-auto">Создать аккаунт</button>
                </div>
            </form>
            <div class="text-center">
                <p>Если у вас уже есть аккаунт, <a href="{{ route('login') }}">войдите</a> в свой личный кабинет.</p>
            </div>
        </div>
    </div>
@endsection
