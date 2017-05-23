<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class: CreateUserWorkExceptionsTable
 *
 * Purpose:
 *
 * Notes:
 *
 * @todo complete class header comments
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
class CreateUserWorkExceptionsTable extends Migration
{
    /**
     * Function: up()
     *
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * Preconditions:
     * -.  users must be created before this table
     * -.  work_exception_types must be creaed before this table
     *
     * @todo a comment below asserts a need to link the work_exception_type_id field to the notification_types
     * table - only, no foreign key constraint has been created on the notification_types table
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_work_exceptions', function (Blueprint $table)
        {
            $table->increments('id')
                  ->comment = 'Primary key.';

            $table->unsignedInteger('user_id')
                  ->index()
                  ->comment = 'Foreign key linking back to the users table.';

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->comment = 'Foreign key constraint linking back to the users table.';

            $table->unsignedInteger('work_exception_type_id')
                  ->index()
                  ->comment = 'Foreign key linking back to the work_exception_types table.';

            $table->foreign('work_exception_type_id')
                  ->references('id')
                  ->on('work_exception_types')
                  ->comment = 'Foreign key constraint linking back to the work_exception_types table.';

            /*
            $table->unsignedInteger('reviewed_by_id')
                  ->index()
                  ->comment = 'Foreign key linking back to the users table.';

            $table->foreign('reviewed_by_id')
                  ->references('id')
                  ->on('users')
                  ->comment = 'Foreign key constraint linking back to the users table.';
             */

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
        Schema::drop('user_work_exceptions');
    }
}
