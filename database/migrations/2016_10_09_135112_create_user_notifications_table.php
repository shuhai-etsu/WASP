<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class: CreateUserNotificationsTable
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
 * Modification History:
 *
 *      Developer           Date        Purpose
 *      ----------------------------------------------------------------------------------------------------------------
 *
 *
 */
class CreateUserNotificationsTable extends Migration
{
    /**
     * Function: up()
     *
     * Purpose: Runs the migration (e.g. creates the table and initializes its constraints).
     *
     * Preconditions:
     * -.  the users table must be created before running this routine
     * -.  the notification_types table must be created before running this routine
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_notifications', function (Blueprint $table)
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

            $table->unsignedInteger('notification_id')
                  ->index()
                  ->comment = 'Foreign key linking back to the notification_types table.';

            $table->foreign('notification_id')
                  ->references('id')
                  ->on('notification_types')
                  ->comment = 'Foreign key constraint linking back to the notification_types table.';

            $table->boolean('reviewed')
                  ->default(false)
                  ->comment = 'Flag used to determine if the notification has been reviewed by the user';

            $table->timestamp('date_reviewed')
                  ->comment = 'Date/time the entry was reviewed by the user.';

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
        Schema::drop('user_notifications');
    }
}
