<?php

namespace App\Repositories;

use app\Helpers\ImageService;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Str;

class CustomerRepository
{
    public function get($request)
    {
        $customers = Customer::with('user')->orderBy('id', 'DESC');

        if (!empty($request->q)) {
            $customers = $customers->where('name', 'Like', '%' . $request->q . '%')
                ->orWhere('id', 'Like', '%' . $request->q . '%');
        }

        $customers = $customers->paginate(8);
        $customers->appends($request->all());
        return $customers;
    }

    public function count($request)
    {
        $customersCount = Customer::with('user')->orderBy('id', 'DESC');

        if (!empty($request->q)) {
            $customersCount = $customersCount->where('name', 'Like', '%' . $request->q . '%')
                ->orWhere('id', 'Like', '%' . $request->q . '%');
        }

        $customersCount = $customersCount->count();
        return $customersCount;
    }

    public static function store($request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->birthdate),
            'role' => 'Customer',
            'random_key' => Str::random(60)
        ]);

        if ($request->hasFile('avatar')) {
            $path = 'img/user/' . $user->name . '-' . $user->id;
            $path = public_path($path);
            $file = $request->file('avatar');

            $imageRepository = new ImageRepository;

            $imageRepository->uploadImage($path, $file);

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
