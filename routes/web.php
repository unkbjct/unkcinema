<?php

use App\Http\Controllers\Admin\GetControllers\CategoryController as AdminCategoryViews;
use App\Http\Controllers\Admin\GetControllers\ContentController as AdminContentViews;
use App\Http\Controllers\Admin\GetControllers\TypeController as AdminTypeViews;
use App\Http\Controllers\Admin\PostControllers\CategoryController as AdminCategoryCore;
use App\Http\Controllers\Admin\PostControllers\ContentController as AdminContentCore;
use App\Http\Controllers\Admin\PostControllers\TypeController as AdminTypeCore;
use App\Http\Controllers\Admin\PostControllers\UserController as AdminUserCore;
use App\Http\Controllers\Admin\PostControllers\VideoController as AdminVideoCore;
use App\Http\Controllers\GetControllers\SingleController as SingleViews;
use App\Http\Controllers\GetControllers\UserController as UserViews;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\PostControllers\PersonalController as PersonalCore;
use App\Http\Controllers\PostControllers\SingleController as SingleCore;
use App\Http\Controllers\PostControllers\UserController as UserCore;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/test", function () {
    dd(json_decode(Cookie::get('continue')));
});

Route::post('/upload/large/file', [HelpController::class, 'uploadLargeFiles'])->name('files.upload.large');

Route::get('/', [SingleViews::class, 'welcome'])->name("home");

Route::get('/search', [SingleViews::class, 'search'])->name("search");

Route::get('/content/{content}', [SingleViews::class, 'content'])->name("content");

Route::get('/login', [SingleViews::class, 'login'])->name("login");

Route::get('/sign-up', [SingleViews::class, 'signUp'])->name("sign-up");

Route::get("/bookmarks", [UserViews::class, 'bookmarks'])->name('user.bookmarks');

Route::group(['prefix' => 'user'], function () {

    Route::get("/{login}", [UserViews::class, 'profile'])->name('user.profile');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', IsAdmin::class]], function () { // ADMIN ----------------------------------------------------

    Route::get('/', [AdminContentViews::class, 'contents'])->name("admin");

    Route::group(['prefix' => 'contents'], function () {

        Route::get('/', [AdminContentViews::class, 'contents'])->name("admin.contents");

        Route::get('/create', [AdminContentViews::class, 'create'])->name("admin.contents.create");

        Route::get('{content}/information', [AdminContentViews::class, 'information'])->name("admin.contents.information");
    });

    Route::group(['prefix' => 'types'], function () {

        Route::get('/', [AdminTypeViews::class, 'types'])->name("admin.types");

        Route::get('/create', [AdminTypeViews::class, 'create'])->name("admin.types.create");

        Route::get('/{type}/information', [AdminTypeViews::class, 'information'])->name("admin.types.information");
    });

    Route::group(['prefix' => 'categories'], function () {

        Route::get('/', [AdminCategoryViews::class, 'categories'])->name("admin.categories");

        Route::get('/create', [AdminCategoryViews::class, 'create'])->name("admin.categories.create");
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [AdminUserCore::class, 'view'])->name("admin.users");
    });
});

Route::group(['prefix' => 'core', 'namepsace' => 'core'], function () {

    Route::post('/personal/sign-up', [PersonalCore::class, 'signUp'])->name('core.personal.sign-up');

    Route::post('/personal/login', [PersonalCore::class, 'login'])->name('core.personal.login');

    Route::get('/personal/logout', [PersonalCore::class, 'logout'])->name('core.personal.logout');

    Route::post('/content/{content}/comment', [SingleCore::class, 'commentCreate'])->name('core.content.comment.create');

    Route::group(['prefix' => 'user'], function () {

        Route::post('/edit/avatar', [UserCore::class, 'editAvatar'])->name('user.edit.avatar');

        Route::post('/edit/cover', [UserCore::class, 'editCover'])->name('user.edit.cover');

        Route::post('/edit/data', [UserCore::class, 'editData'])->name('user.edit.data');

        Route::post('/edit/bookmarks', [UserCore::class, 'bookmarks'])->name('core.user.bookmarks');
    });

    Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'middleware' => IsAdmin::class], function () {

        Route::group(['prefix' => 'contents'], function () {

            Route::post('/create', [AdminContentCore::class, 'create'])->name('core.admin.contents.create');

            Route::post('/{content}/edit', [AdminContentCore::class, 'edit'])->name('core.admin.contents.edit');

            Route::post('/{content}/remove', [AdminContentCore::class, 'remove'])->name('core.admin.contents.remove');
        });

        Route::post('/season/create', [AdminVideoCore::class, 'seasonCreate'])->name('core.admin.season.create');
        Route::post('/season/remove', [AdminVideoCore::class, 'seasonRemove'])->name('core.admin.season.remove');
        Route::post('/episode/create', [AdminVideoCore::class, 'episodeCreate'])->name('core.admin.episode.create');
        Route::post('/episode/remove', [AdminVideoCore::class, 'episodeRemove'])->name('core.admin.episode.remove');
        Route::post('/episode/remove', [AdminVideoCore::class, 'episodeRemove'])->name('core.admin.episode.remove');
        Route::post('/episode/edit', [AdminVideoCore::class, 'episodeEdit'])->name('core.admin.episode.edit');
        Route::post('/setCookie', [SingleCore::class, 'setCookie'])->name('core.cookie.set');

        Route::group(['prefix' => 'types'], function () {

            Route::post('/create', [AdminTypeCore::class, 'create'])->name('core.admin.types.create');

            Route::post('/{type}/edit', [AdminTypeCore::class, 'edit'])->name('core.admin.types.edit');

            Route::post('/{type}/remove', [AdminTypeCore::class, 'remove'])->name('core.admin.types.remove');
        });

        Route::group(['prefix' => 'categories'], function () {

            Route::post('/create', [AdminCategoryCore::class, 'create'])->name('core.admin.categories.create');

            Route::post('/{category}/remove', [AdminCategoryCore::class, 'remove'])->name('core.admin.categories.remove');
        });

        Route::group(['prefix' => 'users'], function () {

            Route::post('/setAdmin', [AdminUserCore::class, 'setUser'])->name('core.admin.user.set');
        });
    });
});
// Route::get('/catalog/{categories}', [SingleViews::class, 'welcome'])->name("home");
