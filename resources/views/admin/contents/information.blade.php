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
        function enableUpload(element) {
            let browseFile = $(element.querySelector(".browseFile"));
            let progress = $(element.querySelector(".progress"));

            let resumable = new Resumable({
                target: '{{ route('files.upload.large') }}',
                query: {
                    _token: '{{ csrf_token() }}',
                    isVideo: (Boolean)(browseFile.data("is-video")),
                    contentId: browseFile.data("content-id"),
                    episodeId: browseFile.data("episode-id"),
                    // season = 
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
                browseFile.text("Дождитесь окончания загрузки")
                browseFile.attr("disabled", "disabled")
                browseFile.next().remove();
                browseFile.prev().remove();
                showProgress();
                resumable.upload() // to actually start uploading.
            });

            resumable.on('fileProgress', function(file) { // trigger when file progress update

                updateProgress(Math.floor(file.progress() * 100));
            });

            resumable.on('fileSuccess', function(file,
                response) { // trigger when file upload complete
                response = JSON.parse(response)
                // $('#videoPreview').attr('src', response.path);
                // $('.card-footer').show();
                browseFile.text("Изменить видео")
                browseFile.removeClass("btn-outline-dark")
                browseFile.addClass("btn-outline-danger")
                browseFile.removeAttr("disabled")
                browseFile.attr("title", "Изменить видео")
                browseFile.before(
                    `<button disabled class="btn btn-sm me-2 btn-dark">Видео загружено</button>`
                )
                browseFile.after(
                    `<a href='${response.path}' target="true" class="btn btn-sm ms-2 btn-dark btn-watch">Посмотреть видео</a>`
                )
                // progress.find('.progress-bar').removeClass('progress-bar-striped');
                // progress.find('.progress-bar').removeClass('progress-bar-animated');
                hideProgress();
            });

            resumable.on('fileError', function(file,
                response) { // trigger when there is any error
                console.log(file, response)
                alert('file uploading error.');
                browseFile.text("Изменить видео")
                browseFile.removeClass("btn-outline-dark")
                browseFile.addClass("btn-outline-danger")
                browseFile.removeAttr("disabled")
                browseFile.attr("title", "Изменить видео")
                browseFile.before(
                    `<button disabled class="btn btn-sm me-2 btn-dark">Не удалось обновить видео</button>`
                )
                browseFile.after(
                    `<a href='${response.path}' target="true" class="btn btn-sm ms-2 btn-dark btn-watch">Посмотреть видео</a>`
                )
                progress.hide();
            });

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
        $(".list-group-item").each(function(index, element) {
            enableUpload(element)
        })
    </script>
@endsection

@section('admin')
    <div class="container">
        <div class="card card-body border border-danger">
            <div class="mb-4">
                <div class="row gy-4 mb-4">
                    <div class="col-md-2">
                        <img class="w-100" src="{{ asset($content->image) }}" alt="">
                    </div>
                    <div class="col-md-4">
                        <div>
                            <div class="display-5 mb-3">{{ $content->title_rus }}</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.contents') }}" class="btn btn-outline-dark mb-3">Все сюжеты</a>
                <a href="{{ route('content', ['content' => $content->id]) }}" class="btn btn-outline-dark mb-3">Страница
                    сюжета</a>
                <div class="fw-semibold h4">Основная информация</div>
            </div>
            <div class="div">
                <form id="form-create" action="{{ route('core.admin.contents.edit', ['content' => $content->id]) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row gy-4">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" name="published" type="checkbox"
                                        @if ($content->published) checked @endif id="published">
                                    <label class="form-check-label" for="published">Доступ сюжета для обычных
                                        пользователей</label>
                                </div>
                            </div>
                        </div>
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
                                <label for="description" class="form-label">Описание</label>
                                <textarea name="description" id="description" class="form-control">{{ $content->description }}</textarea>
                                <div class="form-text">Не обязательное, максимум 10 000 символов.</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="image" class="form-label">Изменить изображение</label>
                                <input type="file" class="form-control" name="image" id="image">
                                <div class="form-text">Обязательное.</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="category" class="form-label">Теги</label>
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
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="type" class="form-label">Категрия Сюжета</label>
                                <select required class="form-select" data-information="1" name="type" id="type"
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
                                <div class="form-text">Чтобы обновилось добавления видео, сохраните основную информаицю о
                                    Сюжете</div>
                            </div>
                            <div id="attributes-list" data-type-id="{{ $content->type->id }}"
                                data-attributes-value="{{ $content->attributes }}">

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3 d-flex">

                            <a href="{{ route('admin.contents.information', ['content' => $content->id]) }}"
                                class="btn ms-auto btn-danger">Отмена</a>
                            <button class="btn ms-3 btn-danger">Сохранить сюжет</button>
                        </div>
                    </div>
                </form>
                <form method="POST" id="form-remove-{{ $content->id }}"
                    action="{{ route('core.admin.contents.remove', ['content' => $content->id]) }}">
                    <button title="Чтобы удалить, удерживайте кнопку 1.5 секунд" data-id="{{ $content->id }}"
                        class="btn ms-3 btn-outline-danger btn-ani-remove" type="button">Удалить
                        сюжет</button>
                    @csrf
                </form>
            </div>
        </div>
        <div class="card card-body border border-danger mt-5">
            <div class="mb-3">
                <div class="fw-semibold h4">Добавление видео</div>
            </div>
            <div class="div">
                @csrf
                <div class="row gy-4">
                    <div class="col-lg-12 change-frame" id="is-one-video-1">
                        <div class="mb-3">
                            <li class="list-group-item list-group-item-action" aria-current="true">
                                <div class="row gy-4">
                                    <div class="col-md-2">
                                        <div class="h-100 d-flex align-items-center">
                                            <div>Видео</div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div>
                                            <div class="upload-container text-center">
                                                @if ($content->video)
                                                    <button disabled="" class="btn btn-sm me-2 btn-dark">Видео
                                                        загружено</button><button type="button"
                                                        class="btn btn-sm browseFile btn-outline-danger"
                                                        data-content-id="{{ $content->id }}" data-is-video="true"
                                                        data-episode-id="{{ $content->video->id }}"
                                                        title="Изменить видео">Изменить
                                                        видео</button><a href="{{ asset($content->video->url) }}"
                                                        class="btn btn-sm ms-2 btn-dark btn-watch"
                                                        target="true">Посмотреть
                                                        видео</a>
                                                @else
                                                    <button type="button" class="btn btn-outline-dark btn-sm browseFile"
                                                        data-is-video="true"
                                                        data-content-id="{{ $content->id }}">Выберите файл</button>
                                                @endif
                                            </div>
                                            <div style="display: none" class="progress mt-3" style="height: 25px">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                    role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                                    aria-valuemax="100" style="width: 75%; height: 100%">75%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                </div>
                            </li>
                        </div>
                    </div>
                    <div class="col-lg-12">

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
            </div>
        </div>
    </div>
@endsection
