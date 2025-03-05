<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Assuming that there are membership types already in the database
        // You can either fetch random membership type IDs or define them manually
        $membershipTypes = \DB::table('membership__types')->pluck('id')->toArray();
        
        foreach (range(1, 100) as $index) { // Creating 10 members for example
            DB::table('members')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'membership_type_id' => $faker->randomElement($membershipTypes), // Random membership type
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'membership_id' => $faker->unique()->lexify('???????'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
