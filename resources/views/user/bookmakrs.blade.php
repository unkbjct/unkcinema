@extends('layouts.main')

@section('main')
    <div class="container">
        <div class="bg-dark text-white mb-5">
            <div class="user-cover position-relative"
                @if (Auth::user()->cover) style="height: 240px; background-image: url({{ asset(Auth::user()->cover) }}); background-size: cover; background-position:0 -60px;"
                @else
                style="height: 240px; background: linear-gradient(126deg, #e66465, #9198e5);" @endif>
            </div>
            <div class="d-flex px-5 pt-3">
                <form action="{{ route('user.edit.avatar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label class="me-4 rounded-circle" for="avatar" style="translate: 0 -80px; cursor: pointer">
                        @if (Auth::user()->img)
                            <div class="rounded-circle border border-2 border-danger bg-secondary"
                                style="height: 140px; width: 140px; background-image: url({{ asset(Auth::user()->img) }}); background-size: cover; background-position:center;">
                            </div>
                        @else
                            <div class="rounded-circle border border-2 border-danger bg-secondary p-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100px" height="100px" fill="currentColor"
                                    class="bi bi-person" viewBox="0 0 16 16">
                                    <path
                                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                                </svg>
                            </div>
                        @endif
                    </label>
                </form>
                <div>
                    <h4>{{ Auth::user()->login }}</h4>
                    <div class="text-white-50">
                        <div>
                            <small>Дата регистрации: {{ date_format(Auth::user()->created_at, 'Y.m.d') }}</small>
                        </div>
                        <div>
                            <small>Всего в закладках: 0</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h4 class="mb-4">Закладки</h4>
            <div class="row">
                @forelse ($contents as $c)
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
                            <div class="text-secondary small">Длительность:
                                @if ($c->duration >= 3600)
                                    {{ gmdate('H:i:s', $c->duration) }}
                                @else
                                    {{ gmdate('i:s', $c->duration) }}
                                @endif
                            </div>
                            <div class="text-secondary small">Автор: <a href="#">unkbjct</a></div>
                        </div>
                    </div>
                @empty
                    <div class="py-5 text-center text-muted fw-bold">
                        <h6 class="mb-5">В данный момент у вес ничего нет в закладках</h6>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
