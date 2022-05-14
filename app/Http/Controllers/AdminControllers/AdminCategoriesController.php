<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoriesController extends Controller
{
    public function index()
    {
        return view('admin_dashboard.categories.index');
    }

    public function create()
    {
        return view('admin_dashboard.categories.create');
    }

    public function store(Request $request)
    {
    }

    public function show(Category $category)
    {
        return view('admin_dashboard.categories.index',[
            'category'=>$category
        ]);
    }

    public function edit(Category $category)
    {
        return view('admin_dashboard.categories.edit',[
            'category'=>$category
        ]);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
