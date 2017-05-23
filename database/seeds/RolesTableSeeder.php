<?php

use Illuminate\Database\Seeder;

/**
 * Class: RolesTableSeeder
 *
 * Purpose: Seeds the roles table with default data.
 *
 * @todo add check for admin role in roles table.  currently, FakeUserTableSeeder.run() requires it
 * @todo remove assumption in FakeUserTableSeeder.run() that the admin role will be id = 3
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
class RolesTableSeeder extends Seeder
{
    /**
     * Function: run()
     *
     * Purpose: Seeds the roles table with default data supplied in a pipe (|) delimited text file.
     *
     * External Dependencies:
     *
     *   -.  /database/seeds/default/roles.txt - initial values for roles table,
     *       formatted as
     *       -.  first line - ordered names of columns into which data in subsequent lines should be placed,
     *                        separated by vertical bars
     *       -.  remaining lines - ordered, vertical-bar-separated data to place into table records, one record per line
     *           the application's design requires that first line must specify all blank fields
     *
     * @return void
     */
    public function run()
    {
        PickListTableSeeder::run("/database/seeds/default/roles.txt","roles");
    }
}
