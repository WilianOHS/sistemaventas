<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'special' => 'all-access',
        ]);

        $user = User::create([
            'name' => 'Admin',
            'username' => 'admin', 
            'email' => 'admin@admin.com',
            'password' => '$2y$10$CCxTjZnh63qEfajMa.iyQeOiw5ncj/Jc5gFgR5qpbZ3sJ4dWu2XUW',
        ]);
        $user->roles()->sync(1);
    }
}

