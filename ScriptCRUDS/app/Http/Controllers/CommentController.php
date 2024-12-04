<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return view('comments.index', ['data' => Comment::all()]);
    }

    public function create()
    {
        return view('comments.create');
    }

    public function store(Request $request)
    {
        Comment::create($request->all());
        return redirect()->route('comments.index');
    }

    public function edit($id)
    {
        $item = Comment::findOrFail($id);
        return view('comments.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Comment::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('comments.index');
    }

    public function destroy($id)
    {
        Comment::destroy($id);
        return redirect()->route('comments.index');
    }
}