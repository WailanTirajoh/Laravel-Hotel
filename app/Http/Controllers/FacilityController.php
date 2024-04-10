<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

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
