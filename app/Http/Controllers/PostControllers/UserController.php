<?php

namespace App\Http\Controllers\PostControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    public function editAvatar(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $path = $request->file("avatar")->store("users/" . $user->login . "/", "public");
        $user->img = "public/storage/{$path}";
        $user->save();

        return redirect()->back()->with(['success' => 'Фотография профиля обнавлена успешно!']);
    }


    public function editCover(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $path = $request->file("cover")->store("users/" . $user->login . "/", "public");
        $user->cover = "public/storage/{$path}";
        $user->save();

        return redirect()->back()->with(['success' => 'Обложка профиля обнавлена успешно!']);
    }


    public function bookmarks(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->back()->withErrors([
                'error' => 'Вы должны быть атворизованы чтобы добавить в закладки!'
            ]);
        }
        $bookmarks = json_decode(Cookie::get("bookmarks", '[]'));
        if (in_array($request->content, $bookmarks)) {
            array_splice($bookmarks, array_search($request->content, $bookmarks), 1);
        } else {
            array_push($bookmarks, $request->content);
        }
        return redirect()->back()->withCookie(cookie()->forever('bookmarks', json_encode($bookmarks)));

    }
}
