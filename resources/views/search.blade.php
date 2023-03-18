@extends('layouts.main')

@section('title')
    Поиск
@endsection

@section('components')
    <link rel="stylesheet" href="{{ asset('public/css/search.css') }}">
@endsection

@section('main')
    <div class="container">
        <div class="card border-0 bg-dark text-white">
            <div class="d-flex">
                <div class="card-body d-flex align-items-center">
                    <div>
                        <input type="text" class="form-control" placeholder="Название">
                    </div>
                </div>
                <button class="btn btn-success ms-auto">
                    Применить
                </button>
                <button class="btn btn-danger ms-auto" data-bs-toggle="collapse" data-bs-target="#collapseExample">
                    Все фильтры
                </button>
            </div>
            <div class="collapse" id="collapseExample">
                <div class="card-body bg-danger">
                    <div class="row gy-4">
                        <div class="col-md-4">
                            <div class="card-body bg-dark">
                                <div class="fw-semibold mb-4">
                                    Категория
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Триллер</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckChecked" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Ужасы</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-body bg-dark">
                                <div class="fw-semibold mb-4">
                                    Жанр
                                </div>
                                <div class="">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Мультфильм</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Сериал</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-body bg-dark">
                                <div class="fw-semibold mb-4">
                                    Страна
                                </div>
                                <div class="">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Триллер</label>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Триллер</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <div class="row gy-4">
                <div class="col-lg-2">
                    <div class="card movie-item">
                        <img src="https://m.media-amazon.com/images/M/MV5BZjRjOTFkOTktZWUzMi00YzMyLThkMmYtMjEwNmQyNzliYTNmXkEyXkFqcGdeQXVyNzQ1ODk3MTQ@._V1_.jpg"
                            alt="">
                        <div class="movie-information">
                            Рик и Морти
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card movie-item">
                        <img src="https://m.media-amazon.com/images/M/MV5BZjRjOTFkOTktZWUzMi00YzMyLThkMmYtMjEwNmQyNzliYTNmXkEyXkFqcGdeQXVyNzQ1ODk3MTQ@._V1_.jpg"
                            alt="">
                        <div class="movie-information">
                            Рик и Морти
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card movie-item">
                        <img src="https://m.media-amazon.com/images/M/MV5BZjRjOTFkOTktZWUzMi00YzMyLThkMmYtMjEwNmQyNzliYTNmXkEyXkFqcGdeQXVyNzQ1ODk3MTQ@._V1_.jpg"
                            alt="">
                        <div class="movie-information">
                            Рик и Морти
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card movie-item">
                        <img src="https://m.media-amazon.com/images/M/MV5BZjRjOTFkOTktZWUzMi00YzMyLThkMmYtMjEwNmQyNzliYTNmXkEyXkFqcGdeQXVyNzQ1ODk3MTQ@._V1_.jpg"
                            alt="">
                        <div class="movie-information">
                            Рик и Морти
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card movie-item">
                        <img src="https://m.media-amazon.com/images/M/MV5BZjRjOTFkOTktZWUzMi00YzMyLThkMmYtMjEwNmQyNzliYTNmXkEyXkFqcGdeQXVyNzQ1ODk3MTQ@._V1_.jpg"
                            alt="">
                        <div class="movie-information">
                            Рик и Морти
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card movie-item">
                        <img src="https://m.media-amazon.com/images/M/MV5BZjRjOTFkOTktZWUzMi00YzMyLThkMmYtMjEwNmQyNzliYTNmXkEyXkFqcGdeQXVyNzQ1ODk3MTQ@._V1_.jpg"
                            alt="">
                        <div class="movie-information">
                            Рик и Морти
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card movie-item">
                        <img src="https://m.media-amazon.com/images/M/MV5BZjRjOTFkOTktZWUzMi00YzMyLThkMmYtMjEwNmQyNzliYTNmXkEyXkFqcGdeQXVyNzQ1ODk3MTQ@._V1_.jpg"
                            alt="">
                        <div class="movie-information">
                            Рик и Морти
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card movie-item">
                        <img src="https://m.media-amazon.com/images/M/MV5BZjRjOTFkOTktZWUzMi00YzMyLThkMmYtMjEwNmQyNzliYTNmXkEyXkFqcGdeQXVyNzQ1ODk3MTQ@._V1_.jpg"
                            alt="">
                        <div class="movie-information">
                            Рик и Морти
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card movie-item">
                        <img src="https://m.media-amazon.com/images/M/MV5BZjRjOTFkOTktZWUzMi00YzMyLThkMmYtMjEwNmQyNzliYTNmXkEyXkFqcGdeQXVyNzQ1ODk3MTQ@._V1_.jpg"
                            alt="">
                        <div class="movie-information">
                            Рик и Морти
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card movie-item">
                        <img src="https://m.media-amazon.com/images/M/MV5BMjJiYjdjNWEtODNiMS00MTBiLWE4NTAtNGNjMDgxZWQzMTgyXkEyXkFqcGdeQXVyMTA3MDk2NDg2._V1_.jpg"
                            alt="">
                        <div class="movie-information">
                            Никто
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card card-body">asd</div>
                </div>
                <div class="col-lg-2">
                    <div class="card card-body">asd</div>
                </div>
            </div>
        </div>
    </div>
@endsection
