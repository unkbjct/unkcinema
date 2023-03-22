<?php

namespace App\Http\Controllers\Admin\GetControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categories(Request $request)
    {
        $request->flash();
        
        $categoires = Category::orderByDesc('id');

        if ($request->has('title') && $request->title)
            $categoires->where("title", "LIKE", "%{$request->title}%");

        $categoires = $categoires->get();

        return view("admin.categories.list", [
            'categories' => $categoires,
        ]);
    }
}