<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Category;

class CategoryController extends Controller
{
    public function index(Category $cat){
    	return view('category.index', ['categories' => $cat->all()]);
    }

    public function create(Category $cat)
    {
        return view('category.create', ['categories' => $cat->all()]);
    }

    public function store(CategoryRequest $request, Category $model)
    {
        $model->create($request->all());
        return redirect()->route('category.index')->withStatus(__('Category successfully created.'));
    }

    public function edit($cat){
        $cats = Category::all();
        $cat = Category::find($cat);
    	return view('category.edit', ['cat' => $cat], ['cats' => $cats->all()]);
    }

    public function update(CategoryRequest $request, $model)
    {
        $model = Category::find($model);
        $model->update($request->all());
        return redirect()->route('category.index')->withStatus(__('Category successfully updated.'));
    }

    public function destroy($cat)
    {
        $cat = Category::find($cat);
        $cat->delete();
        return redirect()->route('category.index')->withStatus(__('Category successfully deleted.'));
    }
}
