<?php

/**
 * Class: PickListTableSeeder
 *
 * Purpose: Populates a pick list table (e.g. States, CertificationTypes, etc.) with data from a text file
 *
 * Requirement(s):
 *
 *      Document                            Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 *
 * Modification History:
 *
 *      Developer           Date            Description
 *      ----------------------------------------------------------------------------------------------------------------
 */

class PickListTableSeeder
{
    /**
     * Function: run()
     * 
     * Purpose: Populates a given pick list database table with data.
     * 
     * Assumptions: Method assumes the data contained in the text file is separated by commas. Method also assumes
     *              the data pairs are in the form [abbreviation],[description]. For example: T,Tennessee. 
     *  
     * @param $file Name, including path, of the text file containing data that is to be stored in the database
     *       file to be formatted as follows:
     *       -.  first line - ordered names of columns into which data in subsequent lines should be placed,
     *                        separated by vertical bars
     *       -.  remaining lines - ordered, vertical-bar-separated data to place into table records, one record per line
     *           the application's design requires that first line must specify all blank fields
     *
     * @param $table Name of the table where the data will be stored
     */
    public static function run($file, $table)
    {
        try
        {
            //==========================================================================================================
            //Attempt to open the text file and, if successful, loop through the entries in the text file and insert the
            //default data into the table
            //==========================================================================================================
            $file = fopen((getcwd() . $file), "r") or die("Unable to open file " . $file);
            if(!feof($file)) {
                $header = trim(fgets($file));
                while(strpos($header, "#") !== false){
                    $header = trim(fgets($file));
                }
                $header = explode("|", $header);
            }

            while (!feof($file))
            {
                $data = trim(fgets($file));

                //======================================================================================================
                //Ignore comments (#) and process the file.
                //======================================================================================================
                if (strlen($data) > 0)
                {
                    $data = explode("|", $data);
                    if (count($header)==2)
                    {
                        DB::table($table)->insert([trim($header[0]) => trim($data[0]),
                            trim($header[1]) => trim($data[1])]);
                    }elseif(count($header)==3){
                        DB::table($table)->insert([trim($header[0]) => trim($data[0]),
                            trim($header[1]) => trim($data[1]),
                            trim($header[2]) => trim($data[2])]);
                    }
                }
            }
        }
        finally
        {
            fclose($file);
        }
    }
}