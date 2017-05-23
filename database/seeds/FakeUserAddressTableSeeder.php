<?php

use Illuminate\Database\Seeder;

use App\User;
use App\UserAddress;

/**
 * Class FakeUserAddressTableSeeder
 *
 * @todo - add class header comment
 */

class FakeUserAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * External Dependencies:
     * -.   reads states.txt to determine possible keys for state table entries
     *
     * @todo - a clearer header comment would be appreciated
     *
     * @todo - process users.txt to determine the number of "real" user accounts in the initial database.
     * 11 just happens to be the number of non-comment lines in default\users.txt as of 02/25/2017
     *
     * @todo - improve on logic for randomizing states data
     * -.  add ordering dependency on preloading of States;
     * -.  use count of record in states to drive randomization of states
     *
     * @return void
     */
    public function run()
    {
        try
        {
            //Only add fake data to fake user accounts.
            $users = User::where('id', '>', 11)->get();
            $faker = Faker\Factory::create();
            $primary = true;
            $total = 0;
            $state = 0;
            $country =0;

            foreach ($users as $user)
            {
                $obj = new UserAddress;

                // start at line 2 in order to account for initial, blank state entry
                $state = rand(2, countLines(database_path('seeds/default/states.txt'))-1);
                $country = rand(2, countLines(database_path('seeds/default/countries.txt'))-1);
                $obj->user_id = $user->id;
                $obj->address1 = $faker->buildingNumber . " " . $faker->streetName;

                if($total % 10 == 0)
                {
                    $obj->address2 = $faker->secondaryAddress;
                }

                $obj->city = $faker->city;
                $obj->state_id = $state;
                $obj->country_id = $country;
                $obj->zipcode = $faker->postcode;
                $obj->is_primary = true;

                $obj->save();
            }

            $primary = true;
        }
        finally
        {
            $obj = null;
            $min = null;
            $max = null;
            $exMin = null;
            $exMax = null;
            $val = null;
            $exVal = null;
            $certID = null;
        }
    }
}
