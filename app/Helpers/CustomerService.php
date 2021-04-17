<?php

namespace app\Helpers;

use App\Http\Requests\StoreCustomerRequest;
use App\Models\Customer;
use App\Models\User;

class CustomerService
{
    public static function storeCustomer(StoreCustomerRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->birthdate),
            'role' => 'Customer'
        ]);

        if ($request->hasFile('avatar')) {
            $path = 'img/user/' . $user->name . '-' . $user->id;
            $path = public_path($path);
            $file = $request->file('avatar');

            ImageService::uploadImage($path, $file);

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

        return $customer;
    }
}
