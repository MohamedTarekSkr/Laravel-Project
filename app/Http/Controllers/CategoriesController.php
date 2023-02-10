<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    function index(){
        $categories = Category::paginate(4);
        return view('main.admin.categories', compact('categories'));
    }
    function create(){
        return view('main.admin.category.create');
    }

   
        function store(Request $request)
        {
    
            $request->validate(Category::$rules);
            $imageUrl = $request->file('image')->store('categories', ['disk' => 'public']);
            $category = new Category;
    
            $category->fill($request->post());
            $category['image'] = $imageUrl;
    
            $category->save();
            return redirect()->route('categories.index');
        }
    
    
    function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('main.admin.category.edit', compact('category'));
    }
    function update($id, Request $request)
    {
        $category = Category::findOrFail($id);

        

        $category->fill($request->post());

        $imageUrl = $request->file('image')->store('categories', ['disk' => 'public']);

        $category['image'] = $imageUrl;

        $category->save();
        return redirect()->route('categories.index');
    }
    function show($id)
    {
        $category = Category::findOrFail($id);
        return view('main.admin.category.show', compact('category'));
    }
    function delete($id)
    {
        $category = Category::findOrFail($id);
        Category::destroy($id);
        return redirect()->route('categories.index')->with('success', 'Record has been deleted successfully!');
    }
}
