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
        <section id="categories" class="mb-5">
            <h1 class="mb-4">Последние добавленные сюжеты</h1>
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
                                {{ $c->description }}
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
