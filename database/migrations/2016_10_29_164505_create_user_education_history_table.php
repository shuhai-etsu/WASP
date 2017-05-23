<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class: CreateUserEducationHistoryTable
 *
 * Purpose: Class is used to create the user_education_history table, which stores a given user's educational
 * achievements, such as graduating with a high school diploma, college degree, etc.
 *
 * Notes: Note
 *
 * Requirement(s):
 *
 *      Document                        Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 *
 * Modification History:
 *
 *      Developer           Date        Purpose
 *      ----------------------------------------------------------------------------------------------------------------
 *
 *
 */
class CreateUserEducationHistoryTable extends Migration
{
    /**
     * Function: up()
     *
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * Preconditions:
     * -.  the users table must be created before running this routine
     * -.  the degree_types table must be created before running this routine
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_education_history', function (Blueprint $table)
        {
            $table->increments('id')
                  ->comment = 'Primary key.';

            $table->unsignedInteger('user_id')
                  ->index()
                  ->comment = 'Foreign key linking back to the users table.';

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->comment = 'Foreign key constraint linking back to the users table.';
            
            $table->string('institution', 255)
                  ->comment = 'Name of the educational institution.';

            $table->unsignedInteger('type_id')
                  ->index()
                  ->comment = 'Foreign key linking back to the degree_types table.';

            $table->foreign('type_id')
                  ->references('id')
                  ->on('degree_types')
                  ->comment = 'Foreign key constraint linking back to the degree_types table.';
            
            $table->date('graduation_date')
                  ->index()
                  ->comment = 'Date the user graduated from an educational institution.';
            
            $table->string('comment', 255)
                  ->nullable()
                  ->comment = 'Brief comment about the entry.';

            //==========================================================================================================
            //See Considerations section above regarding timestamps and softDeletes
            //==========================================================================================================
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @todo should this routine call dropIfExists() instead of drop()?
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_education_history');
    }
}
