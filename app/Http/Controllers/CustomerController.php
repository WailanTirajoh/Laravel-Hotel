<?php

namespace App\Http\Controllers;

use app\Helpers\CustomerService;
use App\Helpers\Helper;
use app\Helpers\ImageService;
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

        $customer = CustomerService::storeCustomer($request);

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
            $avatar_path = 'img/user/' . $user->name . '-' . $user->id;
            $avatar_path = public_path($avatar_path);

            if (is_dir($avatar_path)) {
                ImageService::destroy($avatar_path);
            }

            $customer->delete();
            $user->delete();
            return redirect('customer')->with('success', 'Customer ' . $customer->name . ' deleted!');
        } catch (\Exception $e) {
            return redirect('customer')->with('failed', 'Customer ' . $customer->name . ' cannot be deleted! Error Code:' . $e->errorInfo[1]);
        }
    }
}
