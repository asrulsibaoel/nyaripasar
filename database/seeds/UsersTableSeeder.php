<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'administrator',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'image' => null,
            'description' => 'administrator account',
            'lapak_id' => null,
            'role' => 'admin',
            'registered_date' => date('Y-m-d')
        ]);
    }
}
