<?php

namespace App\Http\Controllers\Admin\GetControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categories()
    {
        $categoires = Category::all();
        return view("admin.categories.list", [
            'categories' => $categoires,
        ]);
    }
}
