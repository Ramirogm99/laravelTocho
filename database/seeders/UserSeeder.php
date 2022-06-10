<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (count(DB::table('users')->where('name', 'Admin')->get()) == 0) {
            DB::table('users')->insert([
                'name' => 'Admin',
                'email' => 'admin@admin',
                'password' => Hash::make('Asdf123$'),
                'auth_level' => '9',
                'remember_token' => Str::random(10),
                'react_token' => Str::random(10),
            ]);
        }
        User::factory()->times(10)->create();
    }
}
