<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Setting::class)->create([
            'solicitude_link' => '#',
            'revision_link' => '#',
            'report_link' => '#'
        ]);
    }
}
