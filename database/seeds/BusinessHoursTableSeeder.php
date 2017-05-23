<?php

use Illuminate\Database\Seeder;

use App\BusinessHour;

/**
 * Class BusinessHoursTableSeeder
 *
 * @todo - add class header comments
 */

class BusinessHoursTableSeeder extends Seeder
{
    /**
     * Function: run()
     *
     * Purpose: Seeds the countries table with default data supplied in a pipe (|) delimited text file.
     *
     * External Dependencies:
     *
     *   -.  /database/seeds/default/business_hours.txt - initial values for business_hours table,
     *       formatted as a combined list of
     *       -.  comment lines - begin with '#'; ignored
     *       -.  data lines - vertical-bar-separated ordered data to place into table records, one record per line
     *
     * @return void
     *
     * Modification History:
     *
     *      Developer           Date            Description
     *      ------------------------------------------------------------------------------------------------------------
     */
    public function run()
    {
        try
        {
            //==========================================================================================================
            //Attempt to open and process the text file that contains default user data
            //==========================================================================================================
            $file = fopen((getcwd() . "/database/seeds/default/business_hours.txt"), "r")
            or die("Unable to open file business_hours.txt");

            while (!feof($file))
            {
                $data = trim(fgets($file));

                //======================================================================================================
                //Ignore comments (#) and process the file.
                //======================================================================================================
                if (strlen($data) > 0 && strpos($data, "#") === false)
                {
                    $data = explode("|", $data);

                    if (count($data) > 0)
                    {
                        $obj = new BusinessHour;

                        $obj->weekday_id = $data[0];
                        $obj->start_time = $data[1];
                        $obj->end_time = $data[2];

                        $obj->save();
                    }
                }
            }
        }
            //==============================================================================================================
            //Free up memory allocated to the function.
            //==============================================================================================================
        finally
        {
            fclose($file);

            $obj = null;
            $data = null;
            $file = null;
        }
    }
}
