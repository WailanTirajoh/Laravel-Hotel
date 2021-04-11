<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(5);
        return view('customer.index', ['customers' => $customers]);
    }

    public function search(Request $request)
    {
        if (!empty($request->q)) {
            $customers = Customer::where('name', 'Like', '%' . $request->q . '%')->paginate(5);
            $customers->appends($request->all());
            return view('customer.index', ['customers' => $customers]);
        } else {
            return redirect('customer');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'address' => 'required|max:255',
            'job' => 'required',
            'birthdate' => 'required|date',
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

    public function update(Customer $customer, Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'email' => 'required|unique:users,email',
            'address' => 'required|max:255',
            'job' => 'required',
            'birthdate' => 'required|date',
        ]);

        // $user = User::find($customer->user->id);
        // $user->update($request->only(['email']));
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
