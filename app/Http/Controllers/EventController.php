<?php

namespace App\Http\Controllers;

use App\Events\MyEvent;
use App\Events\NewReservationEvent;
use App\Events\TestEvent;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function sendEvent()
    {
        // event(new TestEvent('Sent from my Laravel application'));
        $message = 'Reservation added';
        $superAdmins = User::where('role', 'Super')->get();
        foreach($superAdmins as $superAdmin) {
            event(new NewReservationEvent($message,$superAdmin));
        }
        // return view('event.index');
    }

    public function seeEvent()
    {
        return view('event.index');
    }
}
