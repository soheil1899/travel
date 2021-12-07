<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryList()
    {
        return Category::orderBy('id', 'desc')->get();
    }

    public function saveCategory(Request $request)
    {
        $category = ($request->category['id']) ? Category::find($request->category['id']) : new Category();
        $category->title = $request->category['title'];
        $category->content = $request->category['content'];
        $category->save();
    }

    public function deleteCategory($id)
    {
        Category::destroy($id);
    }
}
