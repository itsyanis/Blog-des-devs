<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'Yanis',
            'last_name'  => 'Blogger',
            'email'      => 'yanis@gmail.com',
            'role'       => 'admin',
            'password'   =>  bcrypt('Bl0g@2022'),
            'remember_token' => Str::random(10),
        ]);

        User::factory()->count(3)->create();
    }
}
