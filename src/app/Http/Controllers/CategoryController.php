<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = category::all();

        return view('category',compact('categories'));

    }

    public function store(CategoryRequest $request)
    {
        $category = $request->only('name');
        Category::create($category);

        return redirect('/categories')->with('message','Categoryを作成しました');
    }

    public function update(CategoryRequest $request)
    {
        $category = $request->only('name');
        Category::find($request->category_id)->update($category);

        return redirect('/categories')->with('message','Categoryを更新しました');
    }

    public function destroy(Request $request)
    {
        Category::find($request->category_id)->delete();

        return redirect('/categories')->with('message','Categoryを削除しました');
    }
}
