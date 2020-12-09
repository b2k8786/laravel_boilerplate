<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // use WithFaker;
        
        DB::table('users')->insert([
            'name' => $this->facker->string(),//'Anil_a',
            'email' => 'anil_a@mail.com',
            'password' => Hash::make('123456')
        ]);
    }
}
