<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', ['data' => Post::all()]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        Post::create($request->all());
        return redirect()->route('posts.index');
    }

    public function edit($id)
    {
        $item = Post::findOrFail($id);
        return view('posts.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Post::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route('posts.index');
    }
}