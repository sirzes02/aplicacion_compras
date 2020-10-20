<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
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
        Model::unguard();

        User::create([
            "name" => "Administrador", "email" => "admin@admin.com", "carrito" => "", "password" => bcrypt("123456789")
        ]);
    }
}
