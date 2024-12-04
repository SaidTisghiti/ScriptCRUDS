<?php

namespace App\Http\Controllers;

use App\Models\NewUser;
use Illuminate\Http\Request;

class NewUserController extends Controller
{
    public function index()
    {
        return view('new_users.index', ['data' => NewUser::all()]);
    }

    public function create()
    {
        return view('new_users.create');
    }

    public function store(Request $request)
    {
        NewUser::create($request->all());
        return redirect()->route('new_users.index');
    }

    public function show($id)
    {
        $item = NewUser::findOrFail($id);
        return view('new_users.show', compact('item'));
    }

    public function edit($id)
    {
        $item = NewUser::findOrFail($id);
        return view('new_users.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = NewUser::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('new_users.index');
    }

    public function destroy($id)
    {
        NewUser::destroy($id);
        return redirect()->route('new_users.index');
    }
}