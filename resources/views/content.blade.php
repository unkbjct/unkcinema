@extends('layouts.main')

@section('title')
    Фильм
@endsection

@section('components')
<link rel="stylesheet" href="{{ asset('public/css/plugin.css') }}">
    <script src="{{ asset('public/js/plugin.js') }}"></script>
    <script src="{{ asset('public/js/content.js') }}"></script>
@endsection

@section('main')
    <div class="container">
        <section id="information" class="mb-5">
            <div class="card border-0">
                <div class="card-body bg-dark text-white">
                    <h1 class="display-2 mb-4">Никто</h1>
                    <div class="card border-0 mb-4">
                        <div class="card-body bg-danger text-white">
                            <div class="d-flex flex-wrap">
                                <div class="fw-semibold">2021</div>
                                <div class="vr mx-4"></div>
                                <div class="fw-semibold">1 ч. 31 мин.</div>
                                <div class="vr mx-4"></div>
                                <div class="fw-semibold">18+</div>
                                <div class="vr mx-4"></div>
                                <div class="fw-semibold">США</div>
                                <div class="vr mx-4"></div>
                                <div class="fw-semibold">Криминал</div>
                                <div class="vr mx-4"></div>
                                <div class="fw-semibold">Боевеки</div>
                                <div class="vr mx-4"></div>
                                <div class="fw-semibold">Триллеры</div>
                                <div class="vr mx-4"></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                            <button class="btn btn-danger me-2" data-bs-toggle="tab"
                                data-bs-target="#information-tab">Описание</button>
                            <button class="btn btn-danger me-2" data-bs-toggle="tab"
                                data-bs-target="#trailer-tab">Трейлер</button>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade" id="information-tab">
                                <div class="card-body border-danger border">
                                    Самый безобидный и заурядный обыватель Хатч Мэнселл выходит из себя. После многих лет
                                    тихой
                                    жизни он сталкивается с бандитами и переходит дорогу кровожадному мафиози. Но Хатчу
                                    есть,
                                    чем удивить врагов. Стильный и ироничный экшн-триллер от режиссера «Хардкора» Ильи
                                    Найшуллера по сценарию Дерека Колстада («Джон Уик»). В главной роли – звезда телехитов
                                    «Во
                                    все тяжкие» и «Лучше звоните Солу» Боб Оденкёрк, а его смертельного противника сыграл
                                    Алексей Серебряков.

                                    Хатч – скучный человек со скучной жизнью. Каждый день одно и то же: офисная работа,
                                    городской автобус, тихие вечера домоседа и упреки жены за оставленный мусор. Кто
                                    разглядит в
                                    нем «волка в овечьей шкуре»? Размеренные будни Хатча нарушает вторжение двух неопытных
                                    грабителей, укравших какую-то мелочь и немного напугавших его семью. Хатч даже не
                                    пытается
                                    оказать сопротивление: он хочет «свести ущерб к минимуму». Но уже очень скоро его
                                    терпению
                                    придет конец. Вступившись за незнакомую девушку в автобусе, Хатч перебивает целую свору
                                    молодых головорезов. Один из них оказывается братом беспощадного гангстера Юлиана
                                    Кузнецова
                                    – хранителя «общака» русской мафии. Кузнецов объявляет охоту на безызвестного Хатча,
                                    которому придется вернуться к своему таинственному прошлому и снова взяться за оружие.

                                    Ценителям энергичных боевиков со вкусом и самоиронией предлагаем посмотреть онлайн фильм
                                    «Никто».
                                </div>
                            </div>
                            <div class="tab-pane fade" id="trailer-tab">
                                <div class="card-body border-danger border">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="content">
            <div data-src="{{ asset('public/storage/videos/nobody/nobody.mp4') }}" id="video-container" class="mb-5">
            </div>
        </section>
    </div>
@endsection
