<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class: CreateRoleDefaultSecurityPrivilegesTable
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
class CreateRoleDefaultSecurityPrivilegesTable extends Migration
{
    /**
     * Function: up()
     *
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * Preconditions:
     * -.  the roles table must be created before running this routine
     * -.  the security_privilege_types table must be created before running this routine
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_default_security_privileges', function (Blueprint $table)
        {
            $table->increments('id')
                  ->comment = 'Primary key.';

            $table->unsignedInteger('role_id')
                  ->index()
                  ->comment = 'Foreign key linking back to the roles table.';

            $table->foreign('role_id')
                  ->references('id')
                  ->on('roles')
                  ->comment = 'Foreign key constraint linking back to the roles table.';

            $table->unsignedInteger('security_privilege_id')
                  ->index()
                  ->comment = 'Foreign key linking back to the security_privilege_types table.';

            $table->foreign('security_privilege_id')
                  ->references('id')
                  ->on('security_privilege_types')
                  ->comment = 'Foreign key constraint linking back to the security_privilege_types table.';

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
        Schema::drop('role_default_security_privileges');
    }
}
