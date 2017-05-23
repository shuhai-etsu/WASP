<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\User;
use App\UserCertification;

/**
 * Class FakeUserCertificationsSeeder
 *
 * @todo - add class header comment
 */

class FakeUserCertificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * External Dependencies:
     *  -.  uses /database/seeds/default/certification_types.txt to count initial values for certification_types
     *
     * Preconditions:
     *  -.  assumes user table was initialized
     *  -.  assumes first entry in user table should be ignored
     *  -.  assumes first entry in file should be ignored
     *
     * @todo - improve on logic for randomizing certification data
     *  -.  add ordering dependency on preloading of certification types table;
     *  -.  use count of record in talbe to drive randomization of certification types
     *
     * @return void
     */
    public function run()
    {
        try
        {
            $users = User::where('id', '>', 1)->get();

            $index = 0;

            foreach ($users as $user)
            {
                if(($index % 2) == 0)
                {
                    $certID = rand(2, countLines(database_path('seeds/default/certification_types.txt'))-1);

                    if ($certID > 1)
                    {
                        $obj = new UserCertification;

                        //==============================================================================================
                        // Convert to timestamps
                        //==============================================================================================
                        $min = strtotime("01/01/2016");
                        $max = strtotime("10/17/2016");
                        $exMin = strtotime("12/01/2017");
                        $exMax = strtotime("01/01/2018");

                        $val = rand($min, $max);
                        $exVal = rand($exMin, $exMax);
                        $certID = rand(2, 4);

                        $obj->user_id = $user->id;
                        $obj->certification_id = $certID;
                        $obj->date_certified = Carbon::createFromFormat('Y-m-d', date('Y-m-d', $val))->toDateString();

                        if ($certID != 2)
                        {
                            $obj->expiration_date = Carbon::createFromFormat('Y-m-d', date('Y-m-d', $exVal))->toDateString();
                        }

                        $obj->save();
                    }
                }

                $index++;
            }
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
