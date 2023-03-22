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
use App\Models\Type;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class SingleController extends Controller
{
    public function welcome()
    {
        return view('welcome');
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


        $contentsList = $contentsList->get();

        return view('search', [
            'contentsList' => $contentsList,
            'typesList' => $typesList,
            'categoriesList' => $categoriesList,
        ]);
    }

    public function content(Request $request, Content $content)
    {
        $content->type = Type::find($content->type);
        if ($content->type->is_one_video) {
            $content->video = Video::where("content", $content->id)->first();
        } else {
            $content->seasons = Season::where("content", $content->id)->get();
            if ($content->seasons->isNotEmpty()) {
                $content->seasons->transform(function ($item) {
                    $item->episodes = Episode::where("season", $item->id)->get();
                    return $item;
                });
            }
            if ($request->has('season')) {
                $content->thisSeason = Season::where("content", $content->id)
                    ->where("number", $request->season)
                    ->first();
                if (!$content->thisSeason) {
                    return redirect()->route('content', [
                        'content' => $content->id,
                    ]);
                }
            } else {
                $content->thisSeason = Season::where("content", $content->id)->first();
            }
            if ($request->has('episode')) {
                $content->thisEpisode = Episode::where("season", $content->thisSeason->id)
                    ->where("number", $request->episode)
                    ->first();
                if (!$content->thisEpisode) {
                    return redirect()->route('content', [
                        'content' => $content->id,
                    ]);
                }
            } else {
                $content->thisEpisode = Episode::where("season", $content->thisSeason->id)->first();
            }

            if (Episode::where("season", $content->thisSeason->id)->where("number", $content->thisEpisode->number + 1)->first()) {
                $content->nextEpisode = (Episode::where("season", $content->thisSeason->id)->where("number", $content->thisEpisode->number + 1)->first());
            } else {
                if (Season::where("content", $content->id)->where("number", $content->thisSeason->number + 1)->first()) {
                    $content->nextEpisode = Episode::where("season", Season::where("content", $content->id)->where("number", $content->thisSeason->number + 1)->first()->id)->first();
                } else {
                    $content->nextEpisode = null;
                }
            }
            if ($content->nextEpisode) {
                $content->nextEpisode->seasonNumber = Season::find($content->nextEpisode->season)->number;
            }
        }

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
            ->join("attributes", "Content_attributes.attribute", "=", "attributes.id")
            ->select("Content_attributes.value as value", "attributes.name as name")
            ->get();

        $content->categories = Content_category::where("content", $content->id)
            ->join("Categories", "Content_categories.category", "=", "categories.id")
            ->select("categories.title")
            ->get();

        return view('content', [
            'content' => $content,
            'comments' => $comments,
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
}
