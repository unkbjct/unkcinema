<?php

namespace App\Http\Controllers\Admin\PostControllers;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Content;
use App\Models\Content_attribute;
use App\Models\Content_category;
use App\Models\Type;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TypeController extends Controller
{
    public function create(Request $request)
    {
        if (Type::where("title", $request->title)->get()->isNotEmpty())
            return redirect()->back()->withErrors(['uniq' => 'Категрия должна быть уникальной!']);

        $type = new Type();
        $type->title = $request->title;
        $type->save();
        return redirect()->back()->with(['success' => 'Категрия добавлена успешно!']);
    }

    public function edit(Request $request, Type $type)
    {
        if ($type->title != $request->title && Type::where("title", $request->title)->get()->isNotEmpty())
            return redirect()->back()->withErrors(['uniq' => 'Категрия должна быть уникальной!']);

        if ($type->title != $request->title) $type->title = $request->title;
        $type->save();

        if ($request->has('attributes')) {
            $newAttrList = $request->input('attributes');
            $oldAttrList = Attribute::where("type", $type->id)->get();

            foreach ($newAttrList as $newAttr) {
                $isFounded = false;
                foreach ($oldAttrList as $oldAttr) {
                    if ($newAttr == $oldAttr->name) {
                        $isFounded = true;
                        break;
                    };
                }
                if (!$isFounded) {
                    $attribute = new Attribute();
                    $attribute->type = $type->id;
                    $attribute->name = $newAttr;
                    $attribute->save();
                }
            }
            foreach ($oldAttrList as $oldAttr) {
                $isFounded = false;
                foreach ($newAttrList as $newAttr) {
                    if ($oldAttr->name == $newAttr) {
                        $isFounded = true;
                        break;
                    };
                }
                if (!$isFounded) {
                    Content_attribute::where("attribute", "=", $oldAttr->id)->delete();
                    $oldAttr->delete();
                }
            }
        }

        return redirect()->back()->with(['success' => 'Категрия обновлена успешно!']);
    }

    public function remove(Type $type)
    {
        foreach (Content::where("type", "=", $type->id)->get() as $content) {
            Content_attribute::where("content", $content->id)->delete();
            Content_category::where("content", $content->id)->delete();
            $video = Video::where("content", $content->id)->first();
            Storage::disk('local')->delete("public/contents/" . $content->title_eng . "/" . array_reverse(explode("/", $video->url))[0]);
            $video->delete();
            $content->delete();
        }
        $type->delete();
        return redirect()->route('admin.types')->with(['success' => 'Категрия успешно удалена!']);
    }
}
