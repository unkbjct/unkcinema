@extends('layouts.admin')

@section('title')
    {{ $content->title_rus }}
@endsection

@section('components')
    <link rel="stylesheet" href="{{ asset('public/css/contents.css') }}">
    <script src="{{ asset('public/js/contents.js') }}"></script>
    <script src="{{ asset('public/js/resumable.js') }}"></script>
    <script src="{{ asset('public/js/jquery-3.6.4.min.js') }}"></script>
@endsection

@section('scripts')
    <script type="text/javascript">
        var seasonsCount = 0;

        if (document.getElementById("add-season")) {
            document.getElementById("add-season").addEventListener("click", function() {
                seasonsCount++;
                let element =
                    '<div class="accordion-item">' +
                    '<h2 class="accordion-header">' +
                    '<button class="accordion-button" type="button" data-bs-toggle="collapse"' +
                    `data-bs-target="#collapseSeason${seasonsCount}"><span class="number-season">${seasonsCount} Сезон</span></button>` +
                    '</h2>' +
                    `<div id="collapseSeason${seasonsCount}" class="accordion-collapse collapse show">` +
                    '<div class="accordion-body">' +
                    '<div class="d-flex">' +
                    `<button type="button" data-episodes-count="0" data-season="${seasonsCount}" class="btn btn-dark mb-3 add-episode">Добавить серию</button>` +
                    '<button type="button" class="btn btn-outline-danger ms-auto mb-3 remove-season">Удалить сезон</button>' +
                    '</div>' +
                    '<ul class="list-group">' +
                    '</ul>' +
                    '</div>' +
                    '</div>' +
                    '</div>'
                document.getElementById("seasons-list").insertAdjacentHTML("afterbegin", element)
            })
        }

        if (document.getElementById("seasons-list")) {
            // console.log(this.querySelectorAll())
            document.getElementById("seasons-list").addEventListener("click", function(e) {
                if (e.target.classList.contains("add-episode")) {
                    let btn = e.target;
                    btn.dataset.episodesCount++;
                    element =
                        '<li class="list-group-item list-group-item-action" aria-current="true">' +
                        '<div class="row gy-4">' +
                        '<div class="col-md-2">' +
                        `<div class="h-100 d-flex align-items-center"><div><span class="number">${btn.dataset.episodesCount}</span> Серия</div></div>` +
                        '</div>' +
                        '<div class="col-md-8">' +
                        '<div>' +
                        '<div id="upload-container" class="text-center">' +
                        '<button type="button" id="browseFile" class="btn btn-primary">Brows' +
                        'File</button>' +
                        '</div>' +
                        '<div style="display: none" class="progress mt-3" style="height: 25px">' +
                        '<div class="progress-bar progress-bar-striped progress-bar-animated"' +
                        'role="progressbar" aria-valuenow="75" aria-valuemin="0"' +
                        'aria-valuemax="100" style="width: 75%; height: 100%">75%</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-md-2">' +
                        '<div class="d-flex">' +
                        '<button type="button" class="btn btn-sm btn-danger ms-auto remove-episode">Удалить</button>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</li>'
                    btn.parentElement.nextSibling.insertAdjacentHTML("afterbegin", element)

                    
                    let browseFile = $('#browseFile');
                    let resumable = new Resumable({
                        target: '{{ route('files.upload.large') }}',
                        query: {
                            _token: '{{ csrf_token() }}'
                        }, // CSRF token
                        fileType: ['mp4', 'avi', 'mkv'],
                        chunkSize: 10 * 1024 *
                            1024, // default is 1*1024*1024, this should be less than your maximum limit in php.ini
                        headers: {
                            'Accept': 'application/json'
                        },
                        testChunks: false,
                        throttleProgressCallbacks: 1,
                    });

                    resumable.assignBrowse(browseFile[0]);

                    resumable.on('fileAdded', function(file) { // trigger when file picked
                        showProgress();
                        resumable.upload() // to actually start uploading.
                    });

                    resumable.on('fileProgress', function(file) { // trigger when file progress update
                        updateProgress(Math.floor(file.progress() * 100));
                    });

                    resumable.on('fileSuccess', function(file, response) { // trigger when file upload complete
                        response = JSON.parse(response)
                        // $('#videoPreview').attr('src', response.path);
                        // $('.card-footer').show();
                        alert('success')
                    });

                    resumable.on('fileError', function(file, response) { // trigger when there is any error
                        console.log(file,response)
                        alert('file uploading error.')
                    });


                    let progress = $('.progress');

                    function showProgress() {
                        progress.find('.progress-bar').css('width', '0%');
                        progress.find('.progress-bar').html('0%');
                        progress.find('.progress-bar').removeClass('bg-success');
                        progress.show();
                    }

                    function updateProgress(value) {
                        progress.find('.progress-bar').css('width', `${value}%`)
                        progress.find('.progress-bar').html(`${value}%`)
                    }

                    function hideProgress() {
                        progress.hide();
                    }
                }
                if (e.target.classList.contains("remove-episode")) {
                    let btn = e.target;
                    list = btn.parentElement.parentElement.parentElement.parentElement.parentElement.children;
                    btnAdd = btn.parentElement.parentElement.parentElement.parentElement.parentElement
                        .previousSibling.children[0];
                    btn.parentElement.parentElement.parentElement.parentElement.remove();

                    btnAdd.dataset.episodesCount = list.length;
                    let length = list.length;
                    for (i = 0; i < list.length; i++) {
                        list[i].querySelectorAll(".number")[0].textContent = length
                        list[i].querySelectorAll(".episode-video")[0].setAttribute("name",
                            `episodes[${btnAdd.dataset.season}][${length}]`)

                        length--;
                    }
                }
                if (e.target.classList.contains("remove-season")) {
                    e.target.parentElement.parentElement.parentElement.parentElement.remove();
                    seasonsCount--;
                    let length = seasonsCount;
                    list = document.getElementById("seasons-list").children;
                    for (i = 0; i < list.length; i++) {
                        list[i].querySelector(".accordion-button").dataset.bsTarget = `#collapseSeason${length}`;
                        list[i].querySelector(".accordion-collapse").id = `collapseSeason${length}`;
                        list[i].querySelector(".add-episode").dataset.season = length;
                        list[i].querySelector(".number-season").textContent = length + " Сезон";
                        let episodesLength = list[i].querySelector(".add-episode").dataset.episodesCount;
                        list[i].querySelectorAll(".list-group-item").forEach(item => {
                            item.querySelector(".episode-video").setAttribute("name",
                                `episodes[${length}][${episodesLength}]`)
                            episodesLength--;
                        })
                        length--;
                    }
                }
            })
        }
    </script>
@endsection

@section('admin')
    <div class="container">
        <div class="card card-body border border-danger">
            <div class="mb-4">
                <div class="display-5 mb-3">{{ $content->title_rus }}</div>
                <a href="{{ route('admin.contents') }}" class="btn btn-outline-dark mb-3">Вернуться назад</a>
                <div class="fw-semibold h4">Основная информация</div>
            </div>
            <div class="div">
                <form id="form-create" action="{{ route('core.admin.contents.create') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row gy-4">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="title_rus" class="form-label">Название на русском</label>
                                <input required type="text" value="{{ $content->title_rus }}" class="form-control"
                                    name="title_rus" id="title_rus">
                                <div class="form-text">Обязательное</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="title_eng" class="form-label">Название на английском</label>
                                <input required type="text" value="{{ $content->title_eng }}" class="form-control"
                                    name="title_eng" id="title_eng">
                                <div class="form-text">Или транскрипция, обязательное.</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="description" class="form-label">Описание</label>
                                <textarea name="description" value="{{ $content->description }}" id="description" class="form-control"></textarea>
                                <div class="form-text">Не обязательное, максимум 10 000 символов.</div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="mb-3">
                                <label for="year" class="form-label">Возраст просмотра</label>
                                <input required type="number" value="{{ $content->year }}" class="form-control"
                                    name="year" id="year">
                                <div class="form-text">Цифра, обязательное.</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="image" class="form-label">Изображение</label>
                                <input required type="file" class="form-control" name="image" id="image">
                                <div class="form-text">Обязательное.</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="type" class="form-label">Вид контента</label>
                                <select required class="form-select" name="type" id="type"
                                    aria-label="Default select example">
                                    @foreach ($types as $type)
                                        <option @if ($content->type->id == $type->id) selected @endif
                                            data-is-one-video="{{ $type->is_one_video }}"
                                            data-attributes="{{ $type->attributes }}" value="{{ $type->id }}">
                                            {{ $type->title }}</option>
                                    @endforeach
                                </select>
                                <div class="form-text">Обязательное, если нужного вида нет, добавьте его <a
                                        href="{{ route('admin.types') }}">здесь</a></div>
                            </div>
                            <div id="attributes-list" data-type-id="{{ $content->type->id }}"
                                data-attributes-value="{{ $content->attributes }}">

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="category" class="form-label">Жанры / Теги</label>
                                <div class="input-group">
                                    <select class="form-select" name="category" id="value-category"
                                        aria-label="Default select example">
                                        <option selected></option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-dark" id="add-category">Добавить</button>
                                </div>
                                <div class="form-text">Не обязательное, если нужного жанра нет, добавьте его <a
                                        href="{{ route('admin.categories') }}">здесь</a></div>
                            </div>
                            <div id="categories-list" class="d-flex flex-wrap">
                                @foreach ($content->categories as $category)
                                    <div data-bs-theme="dark" class="categories-item bg-dark text-white">
                                        <div class="me-3">{{ $category->title }}</div>
                                        <input type="hidden" name="categories[]" value="{{ $category->id }}">
                                        <button title="Удалить" type="button" class="btn-close"
                                            aria-label="Close"></button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3 d-flex">
                            <a href="{{ route('admin.contents.information', ['content' => $content->id]) }}"
                                class="btn ms-auto btn-danger">Отмена</a>
                            <button class="btn ms-3 btn-danger">Сохранить контент</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card card-body border border-danger border-top-0">
            <div class="mb-3">
                <div class="fw-semibold h4">Добавление видео</div>
            </div>
            <div class="div">
                <form id="form-create" action="{{ route('core.admin.contents.create') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row gy-4">

                        <div class="col-lg-12 @if (!$content->type->is_one_video) visually-hidden @endif change-frame"
                            id="is-one-video-1">
                            <div class="mb-3">
                                <label for="video" class="form-label">Видео</label>
                                <input type="file" name="video" id="video" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12 @if ($content->type->is_one_video) visually-hidden @endif change-frame"
                            id="is-one-video-0">
                            <div class="mb-3">
                                <div class="mb-3">
                                    <button type="button" id="add-season" class="btn btn-dark">Добавить новый
                                        сезон</button>
                                </div>
                                <div class="accordion" id="seasons-list">

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3 d-flex">
                                <button class="btn ms-auto btn-danger">Создать контент</button>
                            </div>
                        </div>
                        {{-- 
                        <div class="container pt-4">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header text-center">
                                            <h5>Upload File</h5>
                                        </div>

                                        <div class="card-body">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}


                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
