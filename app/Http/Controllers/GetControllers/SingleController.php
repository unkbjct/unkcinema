<?php

namespace App\Http\Controllers\GetControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Content;
use App\Models\Content_attribute;
use App\Models\Content_category;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Tg_user;
use App\Models\Type;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class SingleController extends Controller
{
    public function welcome()
    {
        $continue = json_decode(Cookie::get('continue'));
        if ($continue) {
            $continue->content = Content::find($continue->content);
        }
        return view('welcome', [
            'continue' => $continue,
            'content' => Content::where('published', 1)->join("videos", "contents.id", "=", "videos.content")->select("contents.*", "videos.duration")->get(),
        ]);
    }

    public function search(Request $request)
    {
        $request->flash();

        $typesList = Type::orderByDesc("id")->get();
        $categoriesList = Category::orderByDesc("id")->get();

        $contentsList = Content::where("contents.published", 1)
            ->orderByDesc("contents.id");

        if ($request->has('title') && $request->title) $contentsList->where("title_rus", "LIKE", "%{$request->title}%");
        if ($request->has('types') && $request->types) $contentsList->whereIn("type",  $request->types);
        if ($request->has('categories') && $request->categories) {
            $categoriesArray = Content_category::whereIn("category", $request->categories)->select("content")->distinct()->get();
            $tmpArray = [];
            foreach ($categoriesArray as $contentId) {
                array_push($tmpArray, $contentId->content);
            }
            $contentsList->whereIn("contents.id", $tmpArray);
        }
        if ($request->has('add') && $request->add) {
            $adds = $request->add;
            $tmpQuery = Content_attribute::where(function ($query) use ($adds) {
                foreach ($adds as $addItem) {
                    $query->orwhere('value', 'like',  "{$addItem}");
                }
            })->select('content')->distinct()->get();
            $tmpArray = [];
            foreach ($tmpQuery as $contentId) {
                array_push($tmpArray, $contentId->content);
            }
            if ($tmpArray) $contentsList->whereIn("contents.id", $tmpArray);
        }


        $contentsList = $contentsList->join("videos", "contents.id", "=", "videos.content")->get();

        return view('search', [
            'contentsList' => $contentsList,
            'typesList' => $typesList,
            'categoriesList' => $categoriesList,
        ]);
    }

    public function content(Request $request, Content $content)
    {
        $content->type = Type::find($content->type);
        $content->video = Video::where("content", $content->id)->first();

        $comments = Comment::where("content", $content->id)->orderByDesc('id')->get();

        // Изменяем коллекцию.
        $comments->transform(function ($comment) use ($comments) {
            // Добавляем к каждому комментарию дочерние комментарии.
            $comment->children = $comments->where('parent_id', $comment->id);
            $comment->user = User::find($comment->user);
            if ($comment->parent_id) $comment->setAttribute('parent_user', User::find(Comment::find($comment->parent_id)->user));
            return $comment;
        });

        // Удаляем из коллекции комментарии у которых есть родители.
        $comments = $comments->reject(function ($comment) {
            return $comment->parent_id !== null;
        });

        $content->attributes = Content_attribute::where("content", $content->id)
            ->join("attributes", "content_attributes.attribute", "=", "attributes.id")
            ->select("content_attributes.value as value", "attributes.name as name")
            ->get();

        $content->categories = Content_category::where("content", $content->id)
            ->join("categories", "content_categories.category", "=", "categories.id")
            ->select("categories.title")
            ->get();

        $continue = json_decode(Cookie::get('continue'));

        return view('content', [
            'content' => $content,
            'comments' => $comments,
            'continue' => $continue,
        ]);
    }

    public function login()
    {
        return view('login');
    }

    function signUp()
    {
        return view('sign-up');
    }

    public function notifications()
    {
        return view('notifications');
    }

    public function tgNotifications($tgUser)
    {
        // return t
        return $tgUser;
    }

    public function random(Request $request)
    {
        $request->flash();
        $typesList = Type::orderByDesc("id")->get();
        $categoriesList = Category::orderByDesc("id")->get();

        $content = Content::where("published", 1);
        if ($request->has('title') && $request->title) $content->where("title_rus", "LIKE", "%{$request->title}%");
        if ($request->has('types') && $request->types) $content->whereIn("type",  $request->types);
        if ($request->has('categories') && $request->categories) {
            $categoriesArray = Content_category::whereIn("category", $request->categories)->select("content")->distinct()->get();
            $tmpArray = [];
            foreach ($categoriesArray as $contentId) {
                array_push($tmpArray, $contentId->content);
            }
            $content->whereIn("contents.id", $tmpArray);
        }
        if ($request->has('add') && $request->add) {
            $adds = $request->add;
            $tmpQuery = Content_attribute::where(function ($query) use ($adds) {
                foreach ($adds as $addItem) {
                    $query->orwhere('value', 'like',  "{$addItem}");
                }
            })->select('content')->distinct()->get();
            $tmpArray = [];
            foreach ($tmpQuery as $contentId) {
                array_push($tmpArray, $contentId->content);
            }
            if ($tmpArray) $content->whereIn("contents.id", $tmpArray);
        }
        $content = $content->inRandomOrder()->first();

        if ($content) {
            $content->type = Type::find($content->type);
            $content->attributes = Content_attribute::where("content", $content->id)
                ->join("attributes", "content_attributes.attribute", "=", "attributes.id")
                ->select("content_attributes.value as value", "attributes.name as name")
                ->get();

            $content->categories = Content_category::where("content", $content->id)
                ->join("categories", "content_categories.category", "=", "categories.id")
                ->select("categories.title")
                ->get();
        }

        return view('random', [
            'content' => $content,
            'typesList' => $typesList,
            'categoriesList' => $categoriesList,
        ]);
    }
}
