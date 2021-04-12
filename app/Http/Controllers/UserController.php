<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', ['Super', 'Admin'])->orderBy('id', 'DESC')->Paginate(5, ['*'], 'users');
        $customers = User::where('role', 'Customer')->orderBy('id', 'DESC')->Paginate(5, ['*'], 'customers');
        return view('user.index', compact('users', 'customers'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('user.index')->with('success', 'User ' . $user->name . ' created');
    }

    public function show(User $user)
    {
        if ($user->role === "Customer") {
            $customer = Customer::where('user_id', $user->id)->first();
            return view('customer.show', compact('customer'));
        }
        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }

    public function update(User $user, UpdateCustomerRequest $request)
    {
        $user->update($request->all());
        return redirect()->route('user.index')->with('success', 'User ' . $user->name . ' udpated!');
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('user.index')->with('success', 'User ' . $user->name . ' deleted!');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('failed', 'Customer ' . $user->name . ' cannot be deleted! Error Code:' . $e->errorInfo[1]);;
        }
    }

    public function search(Request $request)
    {
        $users = User::whereIn('role', ['Super', 'Admin'])->where('name', 'LIKE', '%' . $request->q . '%')
            ->orWhere('email', 'LIKE', '%' . $request->q . '%')
            ->paginate(5, ['*'], 'users');
        $customers = User::where('role', 'Customer')->orderBy('id', 'DESC')->Paginate(5, ['*'], 'customers');
        $customers->appends($request->all());
        $users->appends($request->all());
        return view('user.index', compact('users', 'customers'));
    }
}
