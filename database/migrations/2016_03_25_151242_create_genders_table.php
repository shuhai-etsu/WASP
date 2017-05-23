<?php

use Illuminate\Database\Schema\Blueprint;       //Used for creating the schema's blueprint or table structure
use Illuminate\Database\Migrations\Migration;   //Used for creating and droping the table

/**
 * Class: CreateGendersTable
 *
 * Purpose: The class is used create and drop the Genders table, which stores information on the types of genders 
 *          (e.g. male, female, etc.) supported by the application.
 *
 * Considerations: Table uses timestamps() to denote creation and modification dates/times. Table also uses
 *                 softDeletes() to mark the item as deleted rather then removing it from the database since the
 *                 item may be associated with historical data.
 *
 * @todo - deprecate this table; genders have been removed from the data model
 *
 * Requirement(s):
 *
 *      Document                        Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 * Modification History:
 *
 *      Developer           Date        Purpose
 *      ----------------------------------------------------------------------------------------------------------------
 *
 *
 */
class CreateGendersTable extends Migration
{
    /**
     * Function: up()
     *
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * @return void
     *
     * @todo Consider how to adjust the table structure, if necessary, to support nested entries. See ordering notes
     * below.
     */
    public function up()
    {
        Schema::create('genders', function (Blueprint $table)
        {
            $table->increments('id')
                  ->comment = 'Primary key.';

            $table->string('abbreviation', 10)
                  ->unique()
                  ->comment = 'Abbreviation of a given gender entry, such as M for Male.';

            $table->string('description', 25)
                  ->unique()
                  ->comment = 'Description of a given gender entry, such as Male.';

            $table->string('comment', 255)
                  ->nullable()
                  ->comment = 'Brief comment about the given gender entry.';

            $table->boolean('enabled')
                  ->default(true)
                  ->comment = 'Determines if the entry enabled or disabled.';

            $table->boolean('default_selection')
                  ->default(false)
                  ->comment = 'Determines if the entry should be shown as the default selection in UI controls.';

            //==========================================================================================================
            //Need to consider adding an order field for display purposes. Furthermore, determine whether the field
            //should auto-increment or be manually incremented using DB::table(TABLE_NAME)->increment('ordering', VALUE)
            //call.
            //==========================================================================================================
            //$table->integer('ordering')
            //      ->default(0)
            //      ->comment = 'Used to determine the ordering shown in drop down boxes, lists, etc.';

            //==========================================================================================================
            //See Considerations section above regarding timestamps and softDeletes
            //==========================================================================================================
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Function: down()
     *
     * Purpose: Reverses the migration (e.g. drop the table).
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('genders');
    }
}
