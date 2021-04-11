<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTypeRequest;
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

    public function store(StoreTypeRequest $request)
    {
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

    public function update(Type $type, StoreTypeRequest $request)
    {
        $type->update($request->all());
        return redirect('type')->with('success', 'Type ' . $type->name . ' udpated!');
    }

    public function destroy(Type $type)
    {
        try {
            $type->delete();
            return redirect('type')->with('success', 'Type ' . $type->name . ' deleted!');
        } catch (\Exception $e) {
            return redirect('type')->with('failed', 'Type ' . $type->name . ' cannot be deleted! Error Code:' . $e->errorInfo[1]);;
        }
    }
}
