<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/main.css') }}">
    <script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
    @if (Auth::check() && Auth::user()->role == 'ADMIN')
        <script src="{{ asset('public/js/admin.js') }}"></script>
    @endif
    @yield('components')
    <title>@yield('title')</title>
</head>

<body>
    <div class="wrapper">
        <header>
            <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('home') }}">UnkCinema</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-5 mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link @if (str_contains(Request::route()->getName(), 'home')) active @endif"
                                    href="{{ route('home') }}">Главная</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if (str_contains(Request::route()->getName(), 'search')) active @endif"
                                    href="{{ route('search') }}">Поиск</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('random') }}">Рандомайзер</a>
                            </li>
                            {{-- <li class="nav-item @if (str_contains(Request::route()->getName(), 'notifications')) active @endif">
                                <a class="nav-link" href="{{route('notifications')}}">Уведомления</a>
                            </li> --}}
                        </ul>
                        <form class="d-flex me-auto" action="{{ route('search') }}" role="search">
                            <input class="form-control border-end-0" type="search" placeholder="Поиск" name="title">
                            <button class="btn btn-outline-light" type="submit">Найти</button>
                        </form>
                        <ul class="navbar-nav me-5 mb-2 mb-lg-0">
                            @if (Auth::check())
                                <li class="nav-item">
                                    <a class="nav-link @if (Request::route()->getName() == "user.bookmarks") active @endif"
                                        href="{{ route('user.bookmarks') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-bookmark" viewBox="0 0 16 16">
                                            <path
                                                d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                                        </svg>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if (isset($user) && $user->id == Auth::user()->id) active @endif"
                                        href="{{ route('user.profile', ['login' => Auth::user()->login]) }}">{{ Auth::user()->login }}</a>
                                </li>
                                @if (Auth::user()->role == 'ADMIN')
                                    <li class="nav-item">
                                        <a class="nav-link @if (str_contains(Request::route()->getName(), 'admin')) active @endif"
                                            href="{{ route('admin') }}">Админ</a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('core.personal.logout') }}">Выйти</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Авторизоваться</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main class="py-5">
            @yield('main')
            @if (session()->has('success'))
                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <div class="toast fade show">
                        <div class="toast-header border-0">
                            <strong class="me-auto">Успех</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                        </div>
                        <div class="toast-body border-bottom bg-success-subtle">
                            {{ session()->get('success') }}
                        </div>
                    </div>
                </div>
            @endif
            @if ($errors->any())
                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <div class="toast fade show">
                        <div class="toast-header border-0">
                            <strong class="me-auto">Ошибка</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                        </div>
                        <div class="toast-body border-bottom bg-danger-subtle">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </main>
        <footer class="bg-dark">
            <div class="container">
                <div class="py-3 my-4">
                    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                        <li class="nav-item"><a href="{{ route('home') }}" class="nav-link px-2 text-white">Главная</a>
                        </li>
                        <li class="nav-item"><a target="_blank" href="https://t.me/unkbjct"
                                class="nav-link px-2 text-white">Telegram</a></li>
                    </ul>
                    <p class="text-center text-white">© 2022 Company, Inc</p>
                </div>
            </div>
        </footer>
    </div>
    <script src="{{ asset('public/js/main.js') }}"></script>
    @yield('scripts')
</body>

</html>
