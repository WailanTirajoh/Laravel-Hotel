<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::with('user')->orderBy('id', 'DESC');
        if (!empty($request->search)) {
            $customers = $customers->where('name', 'LIKE', '%' . $request->search . '%');
        }
        $customers = $customers->paginate(6);
        $customers->appends($request->all());
        return view('customer.index', compact('customers'));
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(StoreCustomerRequest $request)
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

            Helper::uploadImage($path, $file);

            $user->avatar = $file->getClientOriginalName();
            $user->save();
        }

        $customer = Customer::create([
            'name' => $user->name,
            'address' => $request->address,
            'job' => $request->job,
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'user_id' => $user->id
        ]);

        return redirect('customer')->with('success', 'Customer ' . $customer->name . ' created');
    }

    public function show(Customer $customer)
    {
        return view('customer.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customer.edit', ['customer' => $customer]);
    }

    public function update(Customer $customer, StoreCustomerRequest $request)
    {
        $customer->update($request->all());
        return redirect('customer')->with('success', 'customer ' . $customer->name . ' udpated!');
    }

    public function destroy(Customer $customer)
    {
        try {
            $user = User::find($customer->user->id);
            $path = 'img/user/' . $user->name . '-' . $user->id;
            $path = public_path($path);

            if (is_dir($path)) {
                Helper::destroy($path);
            }

            $customer->delete();
            $user->delete();
            return redirect('customer')->with('success', 'Customer ' . $customer->name . ' deleted!');
        } catch (\Exception $e) {
            return redirect('customer')->with('failed', 'Customer ' . $customer->name . ' cannot be deleted! Error Code:' . $e->errorInfo[1]);
        }
    }
}
