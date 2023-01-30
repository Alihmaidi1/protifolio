<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class defaultuser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions=json_encode(config("permission"));
        User::create([
            "name"=>"Admin",
            "email"=>"alihmaidi095@gmail.com",
            "password"=>Hash::make("ali450892"),
            "permission"=>$permissions
        ]);
    }
}
