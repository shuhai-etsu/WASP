<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Semester;

/**
 * Class SemestersTableSeeder
 *
 * @todo add class header documentation
 */
class SemestersTableSeeder extends Seeder
{
    /**
     * Function: run()
     *
     * Purpose: Seeds the semesters table with default data supplied in a pipe (|) delimited text file.
     *
     * External Dependencies:
     *
     *   -.  /database/seeds/default/semesters.txt - initial values for semesters table,
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
            $file = fopen((getcwd() . "/database/seeds/default/semesters.txt"), "r")
            or die("Unable to open file semesters.txt");

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
                        $obj = new Semester;

                        $obj->abbreviation = trim($data[0]);
                        $obj->description = trim($data[1]);

                        $obj->start_date = Carbon::createFromFormat
                                           (
                                                'Y-m-d',
                                                date('Y-m-d', strtotime(trim($data[2])))
                                           )->toDateString();

                        $obj->end_date = Carbon::createFromFormat
                                         (
                                            'Y-m-d',
                                            date('Y-m-d', strtotime(trim($data[3])))
                                         )->toDateString();

                        $obj->time_increment = trim($data[4]);

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
