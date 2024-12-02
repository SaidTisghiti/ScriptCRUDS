<?php

namespace App\Http\Controllers;

use App\Models\users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', ['data' => users::all()]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        users::create($request->all());
        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $item = users::findOrFail($id);
        return view('users.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = users::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        users::destroy($id);
        return redirect()->route('users.index');
    }
}