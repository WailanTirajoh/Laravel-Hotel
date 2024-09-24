<?php

namespace App\Http\Controllers;

use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    //
    public function index()
    {
        $activities = Activity::paginate(10);

        return view('activity_log.index', compact('activities'));
    }

    public function all()
    {
        $activities = Activity::all();

        return view('activity_log.all', compact('activities'));
    }
}
