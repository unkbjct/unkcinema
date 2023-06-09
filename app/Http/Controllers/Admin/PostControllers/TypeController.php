<?php

namespace App\Http\Controllers\Admin\PostControllers;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function create(Request $request)
    {
        if (Type::where("title", $request->title)->get()->isNotEmpty())
            return redirect()->back()->withErrors(['uniq' => 'Вид должен быть уникальным!']);

        $type = new Type();
        $type->title = $request->title;
        $type->is_one_video = ($request->has("isOneVideo")) ? 1 : 0;
        $type->save();
        return redirect()->back()->with(['success' => 'Вид добавлен успешно!']);
    }

    public function edit(Request $request, Type $type)
    {
        if ($type->title != $request->title && Type::where("title", $request->title)->get()->isNotEmpty())
            return redirect()->back()->withErrors(['uniq' => 'Вид должен быть уникальным!']);

        if ($type->title != $request->title) $type->title = $request->title;
        $type->is_one_video = ($request->has("isOneVideo")) ? 1 : 0;
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
                if (!$isFounded) $oldAttr->delete();
            }
        }

        return redirect()->back()->with(['success' => 'Вид обновлен успешно!']);
    }

    public function remove(Type $type)
    {
        $type->delete();
        return redirect()->route('admin.types')->with(['success' => 'Вид успешно удален!']);
    }
}
