<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(5)->create();
        User::create([
            'name' => 'Wailan Tirajoh',
            'email' => 'wailantirajoh@gmail.com',
            'password' => Hash::make('wailan'),
            'role' => 'Super',
        ]);
    }
}
