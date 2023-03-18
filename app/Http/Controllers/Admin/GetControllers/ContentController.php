<?php

namespace App\Http\Controllers\Admin\GetControllers;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Content;
use App\Models\Content_attribute;
use App\Models\Content_category;
use App\Models\Type;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function contents()
    {
        $contents = Content::join("types", "contents.type", "=", "types.id")
            ->select("contents.*", "types.title as type")
            ->get();
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
