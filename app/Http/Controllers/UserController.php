<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateCustomerRequest;
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

    public function search(Request $request)
    {
        $users = User::whereIn('role', ['Super', 'Admin'])->where('name', 'LIKE', '%' . $request->q . '%')
            ->orWhere('email', 'LIKE', '%' . $request->q . '%')
            ->paginate(5, ['*'], 'customers');
        $customers = User::where('role', 'Customer')->orderBy('id', 'DESC')->Paginate(5, ['*'], 'customers');
        return view('user.index', compact('users', 'customers'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);

        return redirect('user')->with('success', 'User ' . $user->name . ' created');
    }

    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }

    public function update(User $user, UpdateCustomerRequest $request)
    {
        $user->update($request->all());
        return redirect('user')->with('success', 'User ' . $user->name . ' udpated!');
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect('user')->with('success', 'User ' . $user->name . ' deleted!');
        } catch (\Exception $e) {
            return redirect('user')->with('failed', 'Customer ' . $user->name . ' cannot be deleted! Error Code:' . $e->errorInfo[1]);;
        }
    }
}
