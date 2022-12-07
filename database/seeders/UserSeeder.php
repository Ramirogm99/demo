<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        //
        if (count(DB::table('users')->where('name', 'Admin')->get()) == 0) {
            DB::table('users')->insert([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('Asdf123$'),
                'auth_level' => 12,
            ]);
        }
        if (count(DB::table('users')->where('name', 'Demo')->get()) == 0) {
            DB::table('users')->insert([
                'name' => 'Demo',
                'email' => 'demo@demo.com',
                'password' => Hash::make('Asdf123$'),
                'auth_level' => 6,
            ]);
        }
        
    }
}
