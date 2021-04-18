<?php

namespace App\Http\Controllers;

use app\Helpers\CustomerService;
use App\Helpers\Helper;
use App\Http\Requests\ChooseRoomRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Room;
use App\Models\Transaction;
use Illuminate\Http\Request;


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

        $customer = CustomerService::storeCustomer($request);

        return redirect()->route('transaction.reservation.viewCountPerson', ['customer' => $customer->id])->with('success', 'Customer ' . $customer->name . ' created!');
    }

    public function viewCountPerson(Customer $customer)
    {
        return view('transaction.reservation.viewCountPerson', compact('customer'));
    }

    public function chooseRoom(Customer $customer, ChooseRoomRequest $request)
    {
        $stayFrom = $request->check_in;
        $stayUntil = $request->check_out;

        $occupiedRoomId = $this->getOccupiedRoomID($stayFrom, $stayUntil);

        $rooms = Room::with('type', 'roomStatus')
            ->where('capacity', '>=', $request->count_person)
            ->whereNotIn('id', $occupiedRoomId);
        // ->orderBy('price')

        // dd($request->all());
        if (!empty($request->sort_name)) {
            $rooms = $rooms->orderBy($request->sort_name, $request->sort_type);
        }

        $rooms = $rooms
            ->orderBy('capacity')
            ->paginate(5);

        $roomsCount = Room::with('type', 'roomStatus')
            ->where('capacity', '>=', $request->count_person)
            ->whereNotIn('id', $occupiedRoomId)
            ->orderBy('price')
            ->orderBy('capacity')
            ->count();

        return view('transaction.reservation.chooseRoom', compact('customer', 'rooms', 'stayFrom', 'stayUntil', 'roomsCount'));
    }

    public function confirmation(Customer $customer, Room $room, $stayFrom, $stayUntil)
    {
        $price = $room->price;
        $dayDifference = Helper::getDateDifference($stayFrom, $stayUntil);
        $downPayment = ($price * $dayDifference) * 0.15;
        return view('transaction.reservation.confirmation', compact('customer', 'room', 'stayFrom', 'stayUntil', 'downPayment', 'dayDifference'));
    }

    public function payDownPayment(Customer $customer, Room $room, Request $request)
    {
        $stayFrom = $request->check_in;
        $stayUntil = $request->check_out;
        $dayDifference = Helper::getDateDifference($stayFrom, $stayUntil);
        $minimumDownPayment = ($room->price * $dayDifference) * 0.15;

        $request->validate([
            'downPayment' => 'required|numeric|gte:' . $minimumDownPayment
        ]);

        $occupiedRoomId = $this->getOccupiedRoomID($stayFrom, $stayUntil);
        $occupiedRoomIdInArray = $occupiedRoomId->toArray();

        if (in_array($room->id, $occupiedRoomIdInArray)) {
            return redirect()->back()->with('failed', 'Sorry, room ' . $room->number . ' already occupied');
        }

        $transaction = Transaction::create([
            'user_id' => auth()->user()->id,
            'customer_id' => $customer->id,
            'room_id' => $room->id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'status' => 'Reservation'
        ]);

        Payment::create([
            'user_id' => Auth()->user()->id,
            'transaction_id' => $transaction->id,
            'price' => $request->downPayment,
            'status' => 'Down Payment'
        ]);

        return redirect()->route('transaction.index')->with('success', 'Room ' . $room->number . ' has been reservated by ' . $customer->name);
    }

    private function getOccupiedRoomID($stayFrom, $stayUntil)
    {
        $occupiedRoomId = Transaction::where([['check_in', '<=', $stayFrom], ['check_out', '>=', $stayUntil]])
            ->orWhere([['check_in', '>=', $stayFrom], ['check_in', '<=', $stayUntil]])
            ->orWhere([['check_out', '>=', $stayFrom], ['check_out', '<=', $stayUntil]])
            ->pluck('room_id');
        return $occupiedRoomId;
    }
}
