<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('roles')->insert([
      'role_name' => 'Admin',
      ]);
      DB::table('roles')->insert([
      'role_name' => 'Author',
      ]);
      DB::table('roles')->insert([
      'role_name' => 'Teacher',
      ]);
      DB::table('roles')->insert([
      'role_name' => 'Student',
      ]);
    }
}
