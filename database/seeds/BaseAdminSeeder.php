<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class BaseAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@gmail.com',
            'name' => 'Base Admin',
            'password' => bcrypt('admin'),
            'is_admin' => true,
        ]);
    }
}
