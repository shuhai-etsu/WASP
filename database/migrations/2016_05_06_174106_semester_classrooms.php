<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class: SemesterClassrooms
 *
 * Purpose:
 *
 * Notes:
 *
 * @todo complete class header documentation
 * @todo rename for consistency with other table-creating migration logic
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
class SemesterClassrooms extends Migration
{
    /**
     * Function: up()
     *
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * Preconditions:
     * -.  semesters table must be created before running this routine
     * -.  classrooms table must be created before running this routine
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semester_classrooms', function (Blueprint $table)
        {
            $table->increments('id')
                  ->comment = 'Primary key.';

            $table->unsignedInteger('semester_id')
                  ->index()
                  ->comment = 'Foreign key associated with a given semesters.';

            $table->foreign('semester_id')
                  ->references('id')
                  ->on('semesters')
                  ->comment = 'Foreign key constraint linking back to the semesters table.';

            $table->unsignedInteger('classroom_id')
                  ->index()
                  ->comment = 'Foreign key associated with a given classroom.';

            $table->foreign('classroom_id')
                  ->references('id')
                  ->on('classrooms')
                  ->comment = 'Foreign key constraint linking back to the classrooms table.';

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
        Schema::drop('semester_classrooms');
    }
}
