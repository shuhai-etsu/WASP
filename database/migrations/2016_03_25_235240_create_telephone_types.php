<?php

use Illuminate\Database\Schema\Blueprint;       //Used for creating the schema's blueprint or table structure
use Illuminate\Database\Migrations\Migration;   //Used for creating and droping the table

/**
 * Class: CreateTelephoneTypes
 *
 * Purpose:
 *
 * To Do:
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

class CreateTelephoneTypes extends Migration
{
    /**
     * Function Name: up()
     *
     * Purpose: Used to run the migration that creates the telephone_types database table. The table is used to store
     *          the types of telephones a given user may use/have, such as mobile, home, work, etc. The table will
     *          typically be used to display telephone types in pick lists or drop down boxes for user selection or
     *          referenced in reports for display purposes.
     *
     * Parameters: None
     *
     * @return void
     *
     * @todo Consider how to adjust the table structure, if necessary, to support nested entries. See ordering notes
     * below.
     *
     * Design Considerations:
     *
     *        Table uses timestamps to denote initial create and updates.
     *
     *        Table uses SOFT DELETES since existing records may be associated with a given telephone type. Therefore we
     *        cannot delete the entry. Soft deletes ensures the item remains in the database and maintains referential
     *        integrity.
     */
    public function up()
    {
        Schema::create('telephone_types', function (Blueprint $table)
        {
            $table->increments('id')
                  ->comment('Primary key');

            $table->string('abbreviation', 10)
                  ->unique()
                  ->comment('Abbreviation for a given telephone type, such as M for Mobile');

            $table->string('description', 25)
                  ->unique()
                  ->comment('Description of the given telephone type, such as Mobile');

            $table->string('comment', 255)
                  ->nullable()
                  ->comment('User comment for the given telephone type');

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

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Function Name: up()
     *
     * Purpose: Used to reverse the migration (e.g. drop the table and reset the database).
     *
     * Parameters: None
     *
     * @todo should this routine call dropIfExists() instead of drop()?
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('telephone_types');
    }
}
