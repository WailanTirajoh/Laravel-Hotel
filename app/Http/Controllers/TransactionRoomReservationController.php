<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TransactionRoomReservationController extends Controller
{

    public function pickFromCustomer(Request $request)
    {
        $customers = Customer::with('user')->orderBy('id', 'DESC');
        $customersCount = Customer::with('user')->orderBy('id', 'DESC');
        if (!empty($request->q)) {
            $customers = $customers->where('name', 'Like', '%' . $request->q . '%')
                ->orWhere('id', 'Like', '%' . $request->q . '%');
            $customersCount = $customersCount->where('name', 'Like', '%' . $request->q . '%')
                ->orWhere('id', 'Like', '%' . $request->q . '%');
        }
        $customers = $customers->paginate(8);
        $customersCount = $customersCount->count();
        $customers->appends($request->all());
        return view('transaction.reservation.pickFromCustomer', compact('customers', 'customersCount'));
    }

    public function createIdentity()
    {
        return view('transaction.reservation.createIdentity');
    }

    public function storeCustomer(StoreCustomerRequest $request)
    {
        $request->validate([
            'email' => 'required|unique:users,email',
            'avatar' => 'mimes:png,jpg',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->birthdate),
            'role' => 'Customer'
        ]);

        // If user upload an avatar
        if ($request->hasFile('avatar')) {
            $path = 'img/user/' . $user->name . '-' . $user->id;
            $path = public_path($path);
            $file = $request->file('avatar');
            // Check if folder not exists then create folder
            if (!is_dir($path)) {
                mkdir($path);
            }
            $avatarName = $file->getClientOriginalName();
            $img = Image::make($file->path());
            $img->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path . '/' . $avatarName);
            $user->avatar = $avatarName;
            $user->save();
        }


        $customer = Customer::create([
            'name' => $user->name,
            'address' => $request->address,
            'job' => $request->job,
            'birthdate' => $request->birthdate,
            'user_id' => $user->id
        ]);

        return redirect()->route('transaction.reservation.countPerson', ['customer' => $customer->id])->with('success', 'Customer ' . $customer->name . ' created!');
    }

    public function countPerson(Customer $customer)
    {
        return view('transaction.reservation.countPerson', compact('customer'));
    }

    public function chooseRoom(Customer $customer, Request $request)
    {
        $request->validate([
            'count_person' => 'required|numeric',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in'
        ]);

        $from = $request->check_in;
        $to = $request->check_out;

        // CI < F && CO > T
        // CI > F && CI < T
        // CO > F && CO < T
        $notAvailable = Transaction::where([['check_in', '<=', $from], ['check_out', '>=', $to]])
            ->orWhere([['check_in', '>=', $from], ['check_in', '<=', $to]])
            ->orWhere([['check_out', '>=', $from], ['check_out', '<=', $to]])
            ->get();


        $rooms = Room::with('type', 'roomStatus')
            ->orderBy('capacity')
            ->orderBy('price')
            ->where('capacity', '>=', $request->count_person)
            ->whereNotIn('id', $notAvailable->pluck('room_id'))
            ->get();

        return view('transaction.reservation.chooseRoom', compact('customer', 'rooms', 'from', 'to'));
    }

    public function confirmation(Customer $customer, Room $room, $from, $to)
    {
        $price = $room->price;
        $dayDifference = Helper::getDateDifference($from, $to);
        $downPayment = ($price * $dayDifference) * 0.15;
        return view('transaction.reservation.confirmation', compact('customer', 'room', 'from', 'to', 'downPayment', 'dayDifference'));
    }

    public function payDownPayment(Customer $customer, Room $room, Request $request)
    {
        $from = $request->check_in;
        $to = $request->check_out;

        $notAvailable = Transaction::where([['check_in', '<=', $from], ['check_out', '>=', $to]])
            ->orWhere([['check_in', '>=', $from], ['check_in', '<=', $to]])
            ->orWhere([['check_out', '>=', $from], ['check_out', '<=', $to]])
            ->get();

        $notAvailableRoom = $notAvailable->pluck('room_id')->toArray();

        if (in_array($room->id, $notAvailableRoom)) {
            return redirect()->back()->with('failed', 'Sorry, room ' . $room->number . ' is not available at the moment');
        }

        Transaction::create([
            'user_id' => auth()->user()->id,
            'customer_id' => $customer->id,
            'room_id' => $room->id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'status' => 'Reservation'
        ]);

        return redirect()->route('transaction.index')->with('success', 'Room ' . $room->number . ' has been reservated by ' . $customer->name);
    }
}
