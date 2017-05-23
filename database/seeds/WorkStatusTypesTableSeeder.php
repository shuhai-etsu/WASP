<?php

use Illuminate\Database\Seeder;

/**
 * Class: WorkStatusTypesTableSeeder
 *
 * Purpose: Seeds the work_status_types table with default data.
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
class WorkStatusTypesTableSeeder extends Seeder
{
    /**
     * Function: run()
     *
     * Purpose: Seeds the work_status_types table with default data supplied in a pipe (|) delimited text file.
     *
     * External Dependencies:
     *
     *   -.  /database/seeds/default/work_status_types.txt - initial values for work_status_types table, formatted as
     *       -.  first line - ordered names of columns into which data in subsequent lines should be placed,
     *                        separated by vertical bars
     *       -.  remaining lines - ordered, vertical-bar-separated data to place into table records, one record per line
     *           the application's design requires that first line must specify all blank fields
     *
     * @return void
     */
    public function run()
    {
        PickListTableSeeder::run("/database/seeds/default/work_status_types.txt","work_status_types");
    }
}
