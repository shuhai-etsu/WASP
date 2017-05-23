<?php

use Illuminate\Database\Schema\Blueprint;       //Used for creating the schema's blueprint or table structure
use Illuminate\Database\Migrations\Migration;   //Used for creating and droping the table

/**
 * Class: CreateClassroomsTable
 *
 * Purpose: The class is used create and drop the Classrooms table, which stores information on classrooms
 *          to which students are assigned
 *
 * Considerations: Table uses timestamps() to denote creation and modification dates/times. Table also uses
 *                 softDeletes() to mark the item as deleted rather then removing it from the database since the
 *                 item may be associated with historical data.
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
 *      Dave Bishop         11/22/16    Commented out room # and building foreign key references based upon client
 *                                      comments regarding classrooms. Client stated classrooms are not tied to a
 *                                      specific building or room number. The fields were merely commented out in case
 *                                      the client changes the requirement.
 *
 */
class CreateClassroomsTable extends Migration
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
        Schema::create('classrooms', function (Blueprint $table)
        {
            $table->increments('id')
                  ->comment = 'Primary key.';

            $table->string('abbreviation', 10)
                  ->unique()
                  ->comment = 'Abbreviation of a given classroom, such as BB for Bumblebees.';

            $table->string('description', 100)
                  ->unique()
                  ->comment = 'Description of a given classroom, such as Bumblebees.';

            //==========================================================================================================
            //Need Modification History entry, dated 11/22/16, listed above
            //==========================================================================================================
            //$table->string('room', 25);

            $table->unsignedInteger('minimum_students')
                  ->default(0)
                  ->comment = 'Minimum number of students allowed in the classroom';

            $table->unsignedInteger('maximum_students')
                  ->nullable()
                  ->comment = 'Maximum number of students allowed in the classroom';

            $table->string('comment', 255)
                  ->nullable()
                  ->comment = 'Brief comment about the given classroom.';

            $table->boolean('enabled')
                  ->default(true)
                  ->comment = 'Determines if the entry enabled or disabled.';

            $table->boolean('default_selection')
                  ->default(false)
                  ->comment = 'Determines if the entry should be shown as the default selection in UI controls.';

            //==========================================================================================================
            //See Modification History entry, dated 11/22/16, listed above.
            //==========================================================================================================
            /*
            $table->integer('building_id')
                  ->unsigned()
                  ->index()
                  ->comment = 'Foreign key to a buildings table entry that identifies in which building the classroom is 
                               located.';

            $table->foreign('building_id')
                  ->references('id')
                  ->on('buildings')
                  ->comment = 'Foreign key constraint linking back to the buildings table.';
            */

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
     * @todo should this routine call dropIfExists() instead of drop()?
     *
     * @return void
     *
     * Modification History:
     *
     *      Developer           Date            Description
     *      ------------------------------------------------------------------------------------------------------------
     *
     */
    public function down()
    {
        Schema::drop('Classrooms');
    }
}
