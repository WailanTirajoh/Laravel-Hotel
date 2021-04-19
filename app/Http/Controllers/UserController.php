<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::whereIn('role', ['Super', 'Admin'])->orderBy('id', 'DESC');
        $customers = User::where('role', 'Customer')->orderBy('id', 'DESC');

        if (!empty($request->qu)) {
            $users = $users->where('email', 'LIKE', '%' . $request->qu . '%');
        }

        if (!empty($request->qc)) {
            $customers = $customers->where('email', 'LIKE', '%' . $request->qc . '%');
        }

        $users = $users->paginate(5, ['*'], 'users');
        $customers = $customers->Paginate(5, ['*'], 'customers');

        $users->appends($request->all());
        $customers->appends($request->all());
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
            'role' => $request->role,
            'random_key' => Str::random(60)
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
}
