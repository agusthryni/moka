<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'TSDI',
            'email' => 'sdi.industribpp@gmail.com',
            'password' => Hash::make('tsdidkumkmp111'), // Password di-hash untuk keamanan
        ]);
    }
}
