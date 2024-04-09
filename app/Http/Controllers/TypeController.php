<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTypeRequest;
use App\Models\Type;
use App\Repositories\Interface\TypeRepositoryInterface;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function __construct(
        private TypeRepositoryInterface $typeRepository
    ) {
        $this->typeRepository = $typeRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->typeRepository->getTypesDatatable($request);
        }

        return view('type.index');
    }

    public function create()
    {
        $view = view('type.create')->render();

        return response()->json([
            'view' => $view,
        ]);
    }

    public function store(StoreTypeRequest $request)
    {
        $type = $this->typeRepository->store($request);

        return response()->json([
            'message' => 'success', 'Type '.$type->name.' created',
        ]);
    }

    public function edit(Type $type)
    {
        $view = view('type.edit', [
            'type' => $type,
        ])->render();

        return response()->json([
            'view' => $view,
        ]);
    }

    public function update(Type $type, StoreTypeRequest $request)
    {
        $type->update($request->all());

        return response()->json([
            'message' => 'success', 'Type '.$type->name.' udpated!',
        ]);
    }

    public function destroy(Type $type)
    {
        try {
            $type->delete();

            return response()->json([
                'message' => 'Type '.$type->name.' deleted!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Type '.$type->name.' cannot be deleted! Error Code:'.$e->errorInfo[1],
            ], 500);
        }
    }
}
