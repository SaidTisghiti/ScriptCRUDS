<?php

namespace App\Http\Controllers;

use App\Models\posts;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', ['data' => posts::all()]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        posts::create($request->all());
        return redirect()->route('posts.index');
    }

    public function edit($id)
    {
        $item = posts::findOrFail($id);
        return view('posts.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = posts::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        posts::destroy($id);
        return redirect()->route('posts.index');
    }
}