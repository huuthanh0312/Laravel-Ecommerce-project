<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Admins')->insert([
            'name' => 'Admin',
            'phone' => '0355739744',
            'email' => 'huuthanhnguyen0312@gmail.com',
            'password' => bcrypt('Thanh@0312'),
            'product' => 1,
            'order' => 1,
            'blog' => 1,
            'report' => 1,
            'return' => 1,
            'stock' => 1,
            'contact' => 1,
            'comment' => 1,
            'setting' => 1,
            'role' => 1,
            'type' => 1,
        ]);
    }
}
