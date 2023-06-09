<?php

namespace App\Http\Controllers\Admin\GetControllers;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function types(Request $request)
    {
        $request->flash();
        
        $types = Type::orderByDesc('id');
        
        if ($request->has("title") && $request->title)
            $types->where("title", "LIKE", "%{$request->title}%");

        $types = $types->get();
        return view('admin.types.list', [
            'types' => $types,
        ]);
    }

    public function create()
    {
        return view("admin.types.create");
    }

    public function information(Type $type)
    {
        $attributes = Attribute::where("type", $type->id)->get();
        return view("admin.types.information", [
            'type' => $type,
            'attributes' => $attributes,
        ]);
    }
}