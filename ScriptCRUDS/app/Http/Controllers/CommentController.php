<?php

namespace App\Http\Controllers;

use App\Models\comments;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return view('comments.index', ['data' => comments::all()]);
    }

    public function create()
    {
        return view('comments.create');
    }

    public function store(Request $request)
    {
        comments::create($request->all());
        return redirect()->route('comments.index');
    }

    public function edit($id)
    {
        $item = comments::findOrFail($id);
        return view('comments.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = comments::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('comments.index');
    }

    public function destroy($id)
    {
        comments::destroy($id);
        return redirect()->route('comments.index');
    }
}