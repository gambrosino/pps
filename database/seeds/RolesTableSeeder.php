<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Role::class)->create(['name' => 'admin']);
        factory(Role::class)->create(['name' => 'student']);
        factory(Role::class)->create(['name' => 'tutor']);
    }
}
