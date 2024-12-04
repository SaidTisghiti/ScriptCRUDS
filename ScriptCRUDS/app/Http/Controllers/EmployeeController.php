<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employees.index', ['data' => Employee::all()]);
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        Employee::create($request->all());
        return redirect()->route('employees.index');
    }

    public function show($id)
    {
        $item = Employee::findOrFail($id);
        return view('employees.show', compact('item'));
    }

    public function edit($id)
    {
        $item = Employee::findOrFail($id);
        return view('employees.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Employee::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('employees.index');
    }

    public function destroy($id)
    {
        Employee::destroy($id);
        return redirect()->route('employees.index');
    }
}