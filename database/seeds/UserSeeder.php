<?php

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
      DB::table('users')->insert([
      'name' => 'Admin',
      'username' => 'admin',
      'role_id' => '1',
      'email' => 'admin@gmail.com',
      'password' => bcrypt('rootadmin'),
      ]);
      DB::table('users')->insert([
      'name' => 'Author',
      'username' => 'author',
      'role_id' => '2',
      'email' => 'author@gmail.com',
      'password' => bcrypt('rootauthor'),
      ]);
    }
}
