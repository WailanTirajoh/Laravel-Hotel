<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::paginate(5);
        return view('type.index', [
            'types' => $types
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'information' => 'required',
        ]);

        $type = Type::create([
            'name' => $request->name,
            'information' => $request->information,
        ]);

        return redirect('type')->with('success', 'Type ' . $type->name . ' created');
    }

    public function edit(Type $type)
    {
        return view('type.edit', ['type' => $type]);
    }

    public function update(Type $type, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'information' => 'required',
        ]);

        $type->update($request->all());
        return redirect('type')->with('success', 'Type ' . $type->name . ' udpated!');
    }

    public function destroy(Type $type)
    {
        $type->delete();
        return redirect('type')->with('success', 'Type ' . $type->name . ' deleted!');
    }
}
