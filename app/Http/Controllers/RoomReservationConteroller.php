<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class RoomReservationConteroller extends Controller
{
    public function index()
    {
        return view('reservation.index');
    }

    public function pickFromCustomer()
    {
        $customers = Customer::with('user')->orderBy('id', 'DESC')->paginate(8);
        return view('reservation.pickFromCustomer', compact('customers'));
    }

    public function usersearch(Request $request)
    {
        $customers = Customer::with('user')
            ->where('name', 'Like', '%' . $request->q . '%')
            ->orWhere('id', 'Like', '%' . $request->q . '%')
            ->orderBy('id', 'DESC')->paginate(8);
        $customersCount = Customer::with('user')
            ->where('name', 'Like', '%' . $request->q . '%')
            ->orWhere('id', 'Like', '%' . $request->q . '%')
            ->orderBy('id', 'DESC')->count();
        $customers->appends($request->all());
        return view('reservation.pickFromCustomer', compact('customers', 'customersCount'));
    }

    public function createIdentity()
    {
        return view('reservation.createIdentity');
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

        return redirect()->route('reservation.countPerson', ['customer' => $customer->id])->with('success', 'Customer ' . $customer->name . ' created!');
    }

    public function countPerson(Customer $customer)
    {
        return view('reservation.countPerson', compact('customer'));
    }

    public function chooseRoom(Customer $customer, Request $request)
    {
        $request->validate([
            'count_person' => 'required|numeric'
        ]);
        $rooms = Room::with('type', 'roomStatus')
            ->orderBy('capacity')
            ->orderBy('room_status_id')
            ->orderBy('price')
            ->where('capacity', '>=', $request->count_person)
            ->get();
        return view('reservation.chooseRoom', compact('customer', 'rooms'));
    }
}
