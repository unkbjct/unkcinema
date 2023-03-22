@extends('layouts.main')


@section('main')
    <div class="container">
        <div class="mb-5">
            <h1 class="display-5 mb-5">Подпишись на Уведомления</h1>
            <div>Если ты следишь за каким-то сериалом и не хочешь каждый раз заходить в интернет с вопросом, <i>А вышла ли новая серия моего любимого сериала?</i></div>
            <div><span class="fw-semibold">Есть решение!</span> Просто подпешись на рассылку в телеграм. Для этого:</div>
            <ul class="list-group list-group-numbered my-4">
                <li class="list-group-item">Найди наш телеграм бот: <code>UnkCinemaBot</code></li>
                <li class="list-group-item">Напиши <code>/start</code> или нажми <code>начать</code></li>
                <li class="list-group-item">Пройди этап авторизации</li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div>Напиши боту <code>/addnot</code>, Далее напиши ему уникальный индетификатор сериала</div>
                        <div class="text-muted"> уникальный индетификатор сериала, его можно посмотреть <a href="">здесь</a></div>
                    </div>
                </li>
            </ul>
            <div>Все, теперь ты будешь получать уведомление о выходе каждой новой серии</div>
        </div>
        <div class="mb-5">
            <h2 class="h4">О том как отменить уведомление</h2>
            <div><span class="fw-semibold">Есть решение!</span> Просто подпешись на рассылку в телеграм. Для этого:</div>
            <ul class="list-group list-group-numbered my-5">
                <li class="list-group-item">Найди наш телеграм бот: <code>UnkCinemaBot</code></li>
                <li class="list-group-item">Напиши <code>/start</code> или нажми <code>начать</code></li>
                <li class="list-group-item">Пройди этап авторизации</li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div>Напиши боту <code>/addnot</code>, Далее напиши ему уникальный индетификатор сериала</div>
                        <div class="text-muted"> уникальный индетификатор сериала, его можно посмотреть <a href="">здесь</a></div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endsection