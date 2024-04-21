<?php

namespace App\Http\Controllers\Admin\PostControllers;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Support\Str;
use App\Models\Content_attribute;
use App\Models\Content_category;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Type;
use App\Models\Video;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function create(Request $request)
    {
        $image = $request->file('image');
        $path = $image->store('contents/' . str_replace(" ", "-", $request->title_eng) . '/', 'public');
        $content = new Content();
        $content->title_rus = $request->title_rus;
        $content->title_eng = Str::slug($request->title_rus);
        // $c
        $content->image = 'public/storage/' . $path;
        $content->type = $request->type;
        if ($request->has('description') && $request->description) $content->description = $request->description;
        $content->save();

        if ($request->has("attributes")) {
            foreach ($request->input("attributes") as $id => $value) {
                if (!$value) continue;
                $newAttr = new Content_attribute();
                $newAttr->content = $content->id;
                $newAttr->attribute = $id;
                $newAttr->value = $value;
                $newAttr->save();
            }
        }

        if ($request->has("categories")) {
            foreach ($request->categories as $category) {
                $newCategory = new Content_category();
                $newCategory->content = $content->id;
                $newCategory->category = $category;
                $newCategory->save();
            }
        }

        return redirect()->route('admin.contents.information', ['content' => $content->id])->with(['success' => 'Контент создан успешно!']);
    }

    public function edit(Request $request, Content $content)
    {
        if ($request->title_rus != $content->title_rus) $content->title_rus = $request->title_rus;
        ($request->has('published')) ? $content->published = 1 : $content->published = 0;
        if ($request->title_eng != $content->title_eng) $content->title_eng = str_replace(" ", "-", $request->title_eng);
        if ($request->description != $content->description) $content->description = $request->description;
        if ($request->year != $content->year) $content->year = $request->year;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('contents/' . str_replace(" ", "-", $request->title_eng) . '/', 'public');
            $content->image = 'public/storage/' . $path;
        }
        if ($request->type != $content->type) $content->type = $request->type;
        $content->save();

        if ($request->has('attributes')) {
            $newAttrList = $request->input('attributes');
            $oldAttrList = Content_attribute::where("content", $content->id)->get();

            foreach ($newAttrList as $key => $value) {
                $isFounded = false;
                foreach ($oldAttrList as $oldAttr) {
                    if ($key == $oldAttr->attribute) {
                        if ($value == null) {
                            $oldAttr->delete();
                        } else if ($value != $oldAttr->value) {
                            $oldAttr->value = $value;
                            $oldAttr->save();
                        }
                        $isFounded = true;
                        break;
                    };
                }
                if (!$isFounded) {
                    if (!$value) continue;
                    $attribute = new Content_attribute();
                    $attribute->content = $content->id;
                    $attribute->attribute = $key;
                    $attribute->value = $value;
                    $attribute->save();
                }
            }
            foreach ($oldAttrList as $oldAttr) {
                $isFounded = false;
                foreach ($newAttrList as $key => $value) {
                    if ($oldAttr->attribute == $key) {
                        $isFounded = true;
                        break;
                    };
                }
                if (!$isFounded) $oldAttr->delete();
            }
        }

        if ($request->has('categories')) {
            $newCategoriesList = $request->input('categories');
            $oldCategoriesLits = Content_category::where("content", $content->id)->get();

            foreach ($newCategoriesList as $categoryId) {
                $isFounded = false;
                foreach ($oldCategoriesLits as $oldCategory) {
                    if ($categoryId == $oldCategory->id) {
                        $isFounded = true;
                        break;
                    };
                }
                if (!$isFounded) {
                    $Content_category = new Content_category();
                    $Content_category->content = $content->id;
                    $Content_category->category = $categoryId;
                    $Content_category->save();
                }
            }
            foreach ($oldCategoriesLits as $oldCategory) {
                $isFounded = false;
                foreach ($newCategoriesList as $categoryId) {
                    if ($oldCategory->id == $categoryId) {
                        $isFounded = true;
                        break;
                    };
                }
                if (!$isFounded) $oldCategory->delete();
            }
        }

        return redirect()->back()->with(['success' => 'Контент обновлен успешно!']);
    }
}
