<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(5);
        return view('customer.index', compact('customers'));
    }

    public function search(Request $request)
    {
        if (!empty($request->q)) {
            $customers = Customer::where('name', 'Like', '%' . $request->q . '%')->paginate(5);
            $customers->appends($request->all());
            return view('customer.index', compact('customers'));
        } else {
            return redirect('customer');
        }
    }

    public function store(StoreCustomerRequest $request)
    {
        $request->validate([
            'email' => 'required|unique:users,email'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->birthdate),
            'role' => 'Customer'
        ]);

        $customer = Customer::create([
            'name' => $user->name,
            'address' => $request->address,
            'job' => $request->job,
            'birthdate' => $request->birthdate,
            'user_id' => $user->id
        ]);

        return redirect('customer')->with('success', 'Customer ' . $customer->name . ' created');
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
            $customer->delete();
            $user->delete();
            return redirect('customer')->with('success', 'Customer ' . $customer->name . ' deleted!');
        } catch (\Exception $e) {
            return redirect('customer')->with('failed', 'Customer ' . $customer->name . ' cannot be deleted! Error Code:' . $e->errorInfo[1]);;
        }
    }
}
