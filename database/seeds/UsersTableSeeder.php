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
	      [
					'id' => 100,
					'name' => "ABC",
					'email' => "abc@xyz.com",
					'password' => bcrypt("12345"),
					'department' => 'CSE',
					'is_admin' => 1
	      ]
	    ]);

    }
}
