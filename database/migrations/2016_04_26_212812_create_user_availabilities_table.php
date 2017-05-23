<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class: CreateUserAvailabilitiesTable
 *
 * Purpose: Class is used create and drop the user_availabilities table, which stores availabilities when a user is 
 *          available to work.
 *
 * Notes: Table uses timestamps() to denote creation and modification dates/times. Table also uses softDeletes() to mark
 *        the item as deleted rather then removing it from the database since the item may be associated with historical
 *        data.
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
 */
class CreateUserAvailabilitiesTable extends Migration
{
    /**
     * Function: up()
     *
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * Preconditions:
     * -.  users table must be created before running this routine
     * -.  weekdays table must be created before running this routine
     * -.  semesters table must be created before running this routine
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_availabilities', function (Blueprint $table)
        {
            $table->increments('id')
                  ->comment = 'Primary key.';

            $table->integer('user_id')
                  ->unsigned()
                  ->index()
                  ->comment = 'Foreign key linking back to the users table.';
            
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->comment = 'Foreign key constraint linking back to the users table.';

            $table->integer('weekday_id')
                  ->unsigned()
                  ->index()
                  ->comment = 'Foreign key linking back to the weekdays table.';
            
            $table->foreign('weekday_id')
                  ->references('id')
                  ->on('weekdays')
                  ->comment = 'Foreign key constraint linking back to the weekdays table.';

            $table->time('start_time')
                  ->index()
                  ->comment = 'Time when an employee can begin work.';;
            
            $table->time('end_time')
                  ->index()
                  ->comment = 'Time when an employee leaves work.';

            $table->unsignedInteger('semester_id')
                  ->index()
                  ->comment = "Foreign key linking back to the semesters table.";
                
            $table->foreign('semester_id')
                  ->references('id')
                  ->on('semesters')
                  ->comment = 'Foreign key constraint linking back to the semesters table.';
            
            $table->string('comment', 255)
                  ->nullable()
                  ->comment = 'Brief comment about the entry';

            //==========================================================================================================
            //See Considerations section above regarding timestamps and softDeletes
            //==========================================================================================================
            $table->timestamps();
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
     */
    public function down()
    {
        Schema::drop('user_availabilities');
    }
}
