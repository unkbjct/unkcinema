<?php

namespace App\Http\Controllers\GetControllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Content;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    public function profile($login)
    {
        $user = User::where("login", $login)->first();
        if (!$user) abort(404);
        $comments = Comment::where("user", $user->id)
            ->join("contents", "comments.content", "=", "contents.id")
            ->select("contents.title_rus as title", "contents.id as content_id", "comments.parent_id", "comments.created_at", "comments.message")
            ->get();
        return view("user.profile", [
            'user' => $user,
            'comments' => $comments,
        ]);
    }

    public function bookmarks()
    {
        $bookmarks = json_decode(Cookie::get("bookmarks", '[]'));

        $contents = Content::whereIn("contents.id", $bookmarks)->where("published", 1)->join("videos", "contents.id", "=", "videos.content")->select("contents.*", "videos.duration")->get();

        return view("user.bookmakrs", [
            'contents' => $contents,
        ]);
    }
}
