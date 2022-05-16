<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminCommentsController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('admin_dashboard.comments.create',[
            'posts'=>Post::pluck('title','id')
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('admin_dashboard.comments.edit',[
            'posts'=>Post::pluck('id','title')
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
