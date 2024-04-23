<?php

namespace App\Http\Controllers\Admin\PostControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Content_category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(Request $request)
    {
        if (Category::where("title", $request->title)->get()->isNotEmpty())
            return redirect()->back()->withErrors(['uniq' => 'Тег должен быть уникальным!']);
        $category = new Category();
        $category->title = $request->title;
        $category->save();
        return redirect()->back()->with(['success' => 'Тег добавлен успешно!']);
    }

    public function remove(Category $category)
    {
        Content_category::where("category", "=", $category->id)->delete();
        $category->delete();

        return redirect()->route('admin.categories')->with(['success' => 'Тег успешно удален!']);
    }
}
