@extends('layouts.main')

@section('title')
    UnkCinema
@endsection

@section('components')
    <link rel="stylesheet" href="{{ asset('public/css/welcome.css') }}">
    <script src="{{ asset('public/js/plugin.js') }}"></script>
@endsection

@section('scripts')
    <script>
        if (document.getElementById("currentTime")) {
            document.getElementById("currentTime").textContent = formatTime((Number)(document.getElementById("currentTime")
                .textContent), ((Number)(document.getElementById("currentTime").textContent) > 3600) ? true : false)
        }
    </script>
@endsection

@section('main')
    <div class="container">
        {{-- @if ($continue)
            <section id="continue" class="mb-5">
                <div class="my display-5 mb-4">Продолжить просмотр</div>
                <div class="card card-body bg-dark text-white" style="cursor: auto">
                    <div class="row gy-4">
                        <div class="col-md-1">
                            <img class="w-100" src="{{ $continue->content->image }}" alt="">
                        </div>
                        <div class="col-md-11">
                            <div class="d-flex flex-column justify-content-evenly h-100">
                                <div class="me-4">
                                    <div class="fs-3 fw-semibold">{{ $continue->content->title_rus }}</div>
                                </div>
                                @if ($continue->isSerial)
                                    <div>{{ $continue->serialInfo->season }} Сезон {{ $continue->serialInfo->episode }}
                                        Серия </div>
                                @endif
                                <div class="d-flex align-items-center">
                                    @if ($continue->isSerial)
                                        <a href="{{ route('content', [
                                            'content' => $continue->content,
                                            'episope' => $continue->serialInfo->episode,
                                            'season' => $continue->serialInfo->season,
                                        ]) }}"
                                            class="btn btn-danger btn-sm me-4">Продолжить просмотр</a>
                                    @else
                                        <a href="{{ route('content', ['content' => $continue->content]) }}"
                                            class="btn btn-danger btn-sm me-4">Продолжить просмотр</a>
                                    @endif
                                    <div>Вы остановились на <span id="currentTime">{{ $continue->time }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif --}}
        <section id="categories" class="mb-5">
            <h1 class="mb-4">Послдение добавленные сюжеты</h1>
            <div class="row">
                @foreach ($content as $c)
                    <div class="col-lg-3">
                        <div class="custom-card">
                            <a href="{{ route('content', ['content' => $c->id]) }}">
                                <div class="custom-card_image">
                                    <img src="{{ asset($c->image) }}" alt="">
                                </div>
                            </a>
                            <h5>{{ $c->title_rus }}</h5>
                            <div class="description">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Obcaecati quaerat optio repellat
                                temporibus architecto cumque ipsam hic, totam accusamus eius ea officiis itaque doloremque
                                a, adipisci incidunt illum natus. Unde.
                            </div>
                            <div class="small">Длительность:
                                @if ($c->duration >= 3600)
                                    {{ gmdate('H:i:s', $c->duration) }}
                                @else
                                    {{ gmdate('i:s', $c->duration) }}
                                @endif
                            </div>
                            <div class="text-secondary small">{{ $c->dateAsCarbon->diffForHumans() }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

        </section>
    </div>
@endsection
