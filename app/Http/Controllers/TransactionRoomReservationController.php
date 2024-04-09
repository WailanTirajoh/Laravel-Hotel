<?php

namespace App\Http\Controllers;

use App\Events\NewReservationEvent;
use App\Events\RefreshDashboardEvent;
use App\Helpers\Helper;
use App\Http\Requests\ChooseRoomRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\NewRoomReservationDownPayment;
use App\Repositories\Interface\CustomerRepositoryInterface;
use App\Repositories\Interface\PaymentRepositoryInterface;
use App\Repositories\Interface\ReservationRepositoryInterface;
use App\Repositories\Interface\TransactionRepositoryInterface;
use Illuminate\Http\Request;

class TransactionRoomReservationController extends Controller
{
    public function __construct(
        private ReservationRepositoryInterface $reservationRepository
    ) {
    }

    public function pickFromCustomer(Request $request, CustomerRepositoryInterface $customerRepository)
    {
        $customers = $customerRepository->get($request);
        $customersCount = $customerRepository->count($request);

        return view('transaction.reservation.pickFromCustomer', [
            'customers' => $customers,
            'customersCount' => $customersCount,
        ]);
    }

    public function createIdentity()
    {
        return view('transaction.reservation.createIdentity');
    }

    public function storeCustomer(StoreCustomerRequest $request, CustomerRepositoryInterface $customerRepository)
    {
        $customer = $customerRepository->store($request);

        return redirect()
            ->route('transaction.reservation.viewCountPerson', ['customer' => $customer->id])
            ->with('success', 'Customer '.$customer->name.' created!');
    }

    public function viewCountPerson(Customer $customer)
    {
        return view('transaction.reservation.viewCountPerson', [
            'customer' => $customer,
        ]);
    }

    public function chooseRoom(ChooseRoomRequest $request, Customer $customer)
    {
        $stayFrom = $request->check_in;
        $stayUntil = $request->check_out;

        $occupiedRoomId = $this->getOccupiedRoomID($request->check_in, $request->check_out);

        $rooms = $this->reservationRepository->getUnocuppiedroom($request, $occupiedRoomId);
        $roomsCount = $this->reservationRepository->countUnocuppiedroom($request, $occupiedRoomId);

        return view('transaction.reservation.chooseRoom', [
            'customer' => $customer,
            'rooms' => $rooms,
            'stayFrom' => $stayFrom,
            'stayUntil' => $stayUntil,
            'roomsCount' => $roomsCount,
        ]);
    }

    public function confirmation(Customer $customer, Room $room, $stayFrom, $stayUntil)
    {
        $price = $room->price;
        $dayDifference = Helper::getDateDifference($stayFrom, $stayUntil);
        $downPayment = ($price * $dayDifference) * 0.15;

        return view('transaction.reservation.confirmation', [
            'customer' => $customer,
            'room' => $room,
            'stayFrom' => $stayFrom,
            'stayUntil' => $stayUntil,
            'downPayment' => $downPayment,
            'dayDifference' => $dayDifference,
        ]);
    }

    public function payDownPayment(
        Customer $customer,
        Room $room,
        Request $request,
        TransactionRepositoryInterface $transactionRepository,
        PaymentRepositoryInterface $paymentRepository
    ) {
        $dayDifference = Helper::getDateDifference($request->check_in, $request->check_out);
        $minimumDownPayment = ($room->price * $dayDifference) * 0.15;

        $request->validate([
            'downPayment' => 'required|numeric|gte:'.$minimumDownPayment,
        ]);

        $occupiedRoomId = $this->getOccupiedRoomID($request->check_in, $request->check_out);
        $occupiedRoomIdInArray = $occupiedRoomId->toArray();

        if (in_array($room->id, $occupiedRoomIdInArray)) {
            return redirect()->back()->with('failed', 'Sorry, room '.$room->number.' already occupied');
        }

        $transaction = $transactionRepository->store($request, $customer, $room);
        $status = 'Down Payment';
        $payment = $paymentRepository->store($request, $transaction, $status);

        $superAdmins = User::where('role', 'Super')->get();

        foreach ($superAdmins as $superAdmin) {
            $message = 'Reservation added by '.$customer->name;
            event(new NewReservationEvent($message, $superAdmin));
            $superAdmin->notify(new NewRoomReservationDownPayment($transaction, $payment));
        }

        event(new RefreshDashboardEvent('Someone reserved a room'));

        return redirect()->route('transaction.index')
            ->with('success', 'Room '.$room->number.' has been reservated by '.$customer->name);
    }

    private function getOccupiedRoomID($stayFrom, $stayUntil)
    {
        return Transaction::where([['check_in', '<=', $stayFrom], ['check_out', '>=', $stayUntil]])
            ->orWhere([['check_in', '>=', $stayFrom], ['check_in', '<=', $stayUntil]])
            ->orWhere([['check_out', '>=', $stayFrom], ['check_out', '<=', $stayUntil]])
            ->pluck('room_id');
    }
}
