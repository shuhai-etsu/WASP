<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class: CreateUserEmergencyContactsTable
 *
 * Purpose: Class is used create and drop the user_emergency_contacts table, which stores emergency contact for a given 
 *          user.
 *
 * Notes: Table uses timestamps() to denote creation and modification dates/times.
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
 *      Dave Bishop         11/15/2016  Removed address information since client advised it was not necessary. Merely
 *                                      commented out the code in case requirements change in the future.
 *
 */
class CreateUserEmergencyContactsTable extends Migration
{
    /**
     * Function: up()
     *
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * Preconditions:
     * -.  users table must be created before running this routine
     * -.  suffixes table must be created before running this routine
     * -.  relationships table must be created before running this routine
     *
     * @todo remove gender field from this table
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_emergency_contacts', function (Blueprint $table)
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

            $table->string('first_name', 25)
                  ->comment = 'First name of a given emergency contact entry.';
            
            $table->string('middle_name', 25)
                  ->comment = 'Middle name of a given emergency contact entry.';
            
            $table->string('last_name', 25)
                  ->comment = 'Last name of a given emergency contact entry.';

            $table->integer('relationship_id')
                  ->unsigned()
                  ->index()
                  ->comment = 'Foreign key linking back to the relationships table.';
            
            $table->foreign('relationship_id')
                  ->references('id')
                  ->on('relationships')
                  ->comment = 'Foreign key constraint linking back to the relationships table.';

            $table->string('telephone_number', 25)
                ->index()
                ->comment = 'Users telephone number.';

            $table->string('email', 50)
                ->unique()
                ->comment = 'Email address for a given user.';

            $table->boolean('is_primary')
                  ->default(0)
                  ->comment = 'Determines if the entry is the primary emergency contact for a given user.';

            $table->string('comment', 255)
                  ->nullable()
                  ->comment = 'Brief comment about the given entry.';
            
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
        Schema::drop('user_emergency_contacts');
    }
}
