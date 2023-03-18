<?php

namespace App\Http\Controllers\Admin\PostControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(Request $request)
    {
        if (Category::where("title", $request->title)->get()->isNotEmpty())
            return redirect()->back()->withErrors(['uniq' => 'Жанр должен быть уникальным!']);
        $category = new Category();
        $category->title = $request->title;
        $category->save();
        return redirect()->back()->with(['success' => 'Жанр добавлен успешно!']);
    }

    public function remove(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories')->with(['success' => 'Жанр успешно удален!']);
    }
}
