<?php

use Illuminate\Database\Schema\Blueprint;       //Used for creating the schema's blueprint or table structure
use Illuminate\Database\Migrations\Migration;   //Used for creating and droping the table

/**
 * Class: CreateBuildingsTable
 *
 * Purpose: The class is used create and drop the building table, which stores information on the buildings that the
 *          daycare operates or owns.
 *
 * @todo - deprecate this code; buildings information has been dropped from the application's requirements
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
 *
 *
 */
class CreateBuildingsTable extends Migration
{
    /**
     * Function: up()
     *
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * @return void
     *
     * @todo Consider using a prefix and postfix for zip codes instead of making it one field. Consider ordering field
     * for displaying data in a user defined order (see ordering notes below).
     */
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table)
        {
            $table->increments('id')
                  ->comment = 'Primary key.';
            
            $table->string('abbreviation', 10)
                  ->unique()
                  ->comment = 'Abbreviation used to identify the building.';
            
            $table->string('description', 100)
                  ->unique()
                  ->comment = 'Description of the building, such as the name of the building.';
            
            $table->string('address1', 100)
                  ->comment = 'Address of the building.';
            
            $table->string('address2', 100)
                  ->comment = 'Continuation address for the building (if needed)';

            $table->string('city', 25)
                  ->comment = 'City where the building is located.';
            
            $table->integer('state_id')
                  ->unsigned()
                  ->index()
                  ->comment = 'Foreign key to a states table entry that identifies in which state the building is 
                               located.';
            
            $table->foreign('state_id')
                  ->references('id')
                  ->on('states')
                  ->comment = 'Foreign key constraint linking back to the states table.';
            
            $table->string('zipcode',10)
                  ->comment = 'Zip code where the building is located.';
            
            $table->string('comment',255)
                  ->nullable()
                  ->comment = 'Brief comment about the given building entry.';

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
        Schema::drop('buildings');
    }
}
