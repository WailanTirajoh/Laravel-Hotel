<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('user')->orderBy('id', 'DESC')->paginate(6);
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
            // Check if folder not exists then create folder
            if (!is_dir($path)) {
                mkdir($path);
            }
            $avatarName = $file->getClientOriginalName();
            $img = Image::make($file->path());
            $img->resize(200, 200, function ($constraint) {
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

            // Check if user has an image folder
            $path = 'img/user/' . $user->name . '-' . $user->id;
            $path = public_path($path);
            // Destroy the folder if theres a file
            if (is_dir($path)) {
                rrmdir($path);
            }

            $customer->delete();
            $user->delete();
            return redirect('customer')->with('success', 'Customer ' . $customer->name . ' deleted!');
        } catch (\Exception $e) {
            return redirect('customer')->with('failed', 'Customer ' . $customer->name . ' cannot be deleted! Error Code:' . $e->errorInfo[1]);
        }
    }

    public function search(Request $request)
    {
        if (!empty($request->q)) {
            $customers = Customer::where('name', 'Like', '%' . $request->q . '%')->paginate(6);
            $customers->appends($request->all());
            return view('customer.index', compact('customers'));
        } else {
            return redirect('customer');
        }
    }
}
