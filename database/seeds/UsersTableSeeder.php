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
        factory(\App\User::class, 3)->create(['role_id' => 3]); // tutors
        factory(\App\User::class, 5)->create(['role_id' => 2]); // students
        factory(\App\User::class, 1)->create([
            'name' => 'Test Admin',
            'email' => 'test@test.com',
            'password' => bcrypt('1234'),
            'role_id' => 1
        ]); // admin
        factory(\App\User::class, 1)->create([
            'name' => 'Test Tutor',
            'email' => 'test@tutor.com',
            'password' => bcrypt('1234'),
            'role_id' => 3
        ]); // tutor
        factory(\App\User::class, 1)->create([
            'name' => 'Test Student',
            'email' => 'test@student.com',
            'password' => bcrypt('1234'),
            'role_id' => 2
        ]); // student
    }
}
