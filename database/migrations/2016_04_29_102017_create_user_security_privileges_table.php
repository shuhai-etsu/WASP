<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class: CreateUserSecurityPrivilegesTable
 *
 * Purpose:
 *
 * Notes:
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
class CreateUserSecurityPrivilegesTable extends Migration
{
    /**
     * Function: up()
     *
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * @return void
     *
     * Preconditions:
     * -.  users table must be created before running this routine
     * -.  security_privilege_types table must be created before running this routine
     *
     * @todo Consider how to adjust the table structure, if necessary, to support nested entries. See ordering notes
     * below.
     *
     */
    public function up()
    {
        Schema::create('user_security_privileges', function (Blueprint $table)
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

            $table->integer('security_privilege_id')
                  ->unsigned()
                  ->index()
                  ->comment = 'Foreign key linking back to the security_privilege_types table.';

            $table->foreign('security_privilege_id')
                  ->references('id')
                  ->on('security_privilege_types')
                  ->comment = 'Foreign key constraint linking back to the security_privilege_types table.';

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
        Schema::drop('user_security_privileges');
    }
}
