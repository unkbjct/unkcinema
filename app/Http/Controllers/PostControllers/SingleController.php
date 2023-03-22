<?php

namespace App\Http\Controllers\PostControllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class SingleController extends Controller
{
    public function commentCreate(Content $content, Request $request)
    {
        // if($request)
        $comment = new Comment();
        $comment->parent_id = $request->parent_id;
        $comment->content = $content->id;
        $comment->user = Auth::user()->id;
        $comment->message = $request->message;
        $comment->save();

        return redirect()->back()->with(['success' => 'Комментарий добавлен успешно']);
    }

    public function setCookie(Request $request)
    {
        // return $request->input();
        $response = new Response('Set Cookie');
        // $response;
        return $response->withCookie(cookie()->forever('continue', json_encode($request->continue)));
    }
}
