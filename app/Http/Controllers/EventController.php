<?php

namespace App\Http\Controllers;

use App\Events\NewReservationEvent;
use App\Models\User;

class EventController extends Controller
{
    public function sendEvent()
    {
        $message = 'Reservation added';
        $superAdmins = User::where('role', 'Super')->get();
        foreach ($superAdmins as $superAdmin) {
            event(new NewReservationEvent($message, $superAdmin));
        }
    }

    public function seeEvent()
    {
        return view('event.index');
    }
}
