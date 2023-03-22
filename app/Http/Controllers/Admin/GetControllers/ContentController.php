<?php

namespace App\Http\Controllers\Admin\GetControllers;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Content;
use App\Models\Content_attribute;
use App\Models\Content_category;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Type;
use App\Models\Video;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function contents(Request $request)
    {
        $request->flash();
        
        $contents = Content::join("types", "contents.type", "=", "types.id")
            ->select("contents.*", "types.title as type")->orderByDesc('id');

        if ($request->has('title') && $request->title != null)
            $contents->where("title_rus", "LIKE", "%{$request->title}%");

        $contents = $contents->get();
        return view('admin.contents.list', [
            'contents' => $contents,
        ]);
    }

    public function create()
    {
        $categories = Category::orderBy("title")->get();
        $types = Type::orderBy("title")->get();
        $types->transform(function ($item) {
            $item->attributes = Attribute::where("type", $item->id)->get();
            return $item;
        });

        return view("admin.contents.create", [
            'categories' => $categories,
            'types' => $types,
        ]);
    }

    public function information(Content $content)
    {
        $content->type = Type::find($content->type);
        $content->categories = Content_category::where("content", $content->id)
            ->join("categories", "content_categories.category", "=", "categories.id")
            ->select("categories.title", "categories.id")
            ->get();
        $content->attributes = Content_attribute::where("content", $content->id)
            ->join("attributes", "content_attributes.attribute", "=", "attributes.id")
            ->select("attributes.name as name", "attributes.id as id", "content_attributes.value as value")
            ->get();
        if ($content->type->is_one_video) {
            $content->video = Video::where("content", $content->id)->first();
        } else {
            $content->seasons = Season::where("content", $content->id)->orderByDesc('id')->get();
            $content->seasons->transform(function ($season) {
                $season->episodes = Episode::where("season", $season->id)->orderByDesc('id')->get();
                return $season;
            });
        }
        $types = Type::orderBy("title")->get();
        $types->transform(function ($item) {
            $item->attributes = Attribute::where("type", $item->id)->get();
            return $item;
        });
        $categories = Category::all();
        // dd($content);
        return view("admin.contents.information", [
            'types' => $types,
            'categories' => $categories,
            'content' => $content,
        ]);
    }
}