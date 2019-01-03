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
            'name' => 'admin',
            'lastname' => 'admin',
            'username' => 'admin',
            'tcno' => '1',
            'phone' => '1',
            'netkesif_email' => 'admin@netkesif.com',
            'email' => 'admin@netkesif.com',
            'password' => bcrypt('123456'),
            'is_admin' => 1,
            'status' => 1,
        ]);
    }
}
