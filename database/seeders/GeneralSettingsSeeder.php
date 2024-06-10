<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneralSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('general__settings')->insert([
            'send_certificate_after' => 7,
            'send_welcome_email_after' => 7,
        ]);
    }
}
