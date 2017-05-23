<?php

use Illuminate\Database\Seeder;

/**
 * Class: DegreeTypesTableSeeder
 *
 * Purpose: Seeds the degree_types table with default data.
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
class DegreeTypesTableSeeder extends Seeder
{
    /**
     * Function: run()
     *
     * External Dependencies:
     *
     *   -.  /database/seeds/default/degree_types.txt - initial values for degree_types table,
     *       formatted as
     *       -.  first line - ordered names of columns into which data in subsequent lines should be placed,
     *                        separated by vertical bars
     *       -.  remaining lines - ordered, vertical-bar-separated data to place into table records, one record per line
     *           the application's design requires that first line must specify all blank fields
     *
     * Purpose: Seeds the degree_types table with default data supplied in a pipe (|) delimited text file.
     *
     * @return void
     */
    public function run()
    {
        PickListTableSeeder::run("/database/seeds/default/degree_types.txt","degree_types");
    }
}
