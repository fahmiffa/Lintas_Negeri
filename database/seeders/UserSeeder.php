<?php

namespace Database\Seeders;
use App\Models\User;
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
            'name'=>'root',
            'password'=>bcrypt('tkw'),
            'email'=>'fa@dec.com',
            'role'=>'admin',
        ]);       


        User::create([
            'name'=>'employee',
            'password'=>bcrypt('tkw'),
            'email'=>'em@dec.com',
            'role'=>'pegawai',
        ]);       

    }
}
