<?php

namespace App\Http\Controllers;

use App\Models\Facility;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::paginate(5);

        return view('facility.index', [
            'facilities' => $facilities,
        ]);
    }
}
