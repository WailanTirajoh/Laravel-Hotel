<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', ['Super', 'Admin'])->orderBy('id', 'DESC')->Paginate(5, ['*'], 'users');
        $customers = User::where('role', 'Customer')->orderBy('id', 'DESC')->Paginate(5, ['*'], 'customers');
        return view('user.index', [
            'users' => $users,
            'customers' => $customers
        ]);
    }

    public function search(Request $request)
    {
        $users = User::where('name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('email', 'LIKE', '%' . $request->search . '%')
            ->paginate(5);
        return view('user.search', ['users' => $users, 'search' => $request->search]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'role' => 'required|in:Super,Admin'
        ]);

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

    public function update(User $user, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'role' => 'required|in:Super,Admin'
        ]);
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
