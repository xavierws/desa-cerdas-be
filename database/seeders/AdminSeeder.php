<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name' => 'SuperAdmin',
            'nik' => '1234567890112223',
            'occupation' => 'superAdmin',
        ]);

        $user = User::create([
            'email' => 'admin@mail.com',
            'password' => Hash::make('Super@dmin_1'),
            'phone' => '081234567890',
            'role_id' => 3,
            'userable_id' => $admin->id,
            'userable_type' => 'App\Models\Admin',
        ]);
    }
}
