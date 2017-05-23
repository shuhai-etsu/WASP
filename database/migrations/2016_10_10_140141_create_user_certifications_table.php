<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class: CreateUserCertificationsTable
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
class CreateUserCertificationsTable extends Migration
{
    /**
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * Preconditions:
     * -.  the users table must be created before running this routine
     * -.  the certification_types table must be created before running this routine
     *
     * @return void
     *
     * @todo Check to make sure index is working properly on nullable fields, specifically expiration_date
     *
     */
    public function up()
    {
        Schema::create('user_certifications', function (Blueprint $table)
        {
            $table->increments('id');

            $table->unsignedInteger('user_id')
                  ->index()
                  ->comment = 'Foreign key linking back to a given user in the users table.';

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->comment = 'Foreign key constraint linking back to the users table.';

            $table->unsignedInteger('certification_id')
                  ->index()
                  ->comment = 'Foreign key linking back to the certification_types table.';

            $table->foreign('certification_id')
                  ->references('id')
                  ->on('certification_types')
                  ->comment = 'Foreign key constraint linking back to the certification_types table.';
            
            $table->date('date_certified')
                  ->index()
                  ->comment = 'Date the user obtained the certification.';
            
            $table->date('expiration_date')
                  ->nullable() //default('1900-01-01')
                  ->index()
                  ->comment = 'Date the certification expires (if applicable).';
            
            $table->string('comment',255)
                  ->nullable()
                  ->comment = 'Brief comment regarding the entry.';

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
     *
     */
    public function down()
    {
        Schema::drop('user_certifications');
    }
}
