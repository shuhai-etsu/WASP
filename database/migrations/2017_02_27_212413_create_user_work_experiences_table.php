<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class: CreateUserWorkExperiencesTable
 *
 * Purpose: Class is used create and drop the user_work_experiences table, which stores work experience information for a given user.
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
 *
 */


class CreateUserWorkExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_work_experiences', function (Blueprint $table) {
            $table->increments('id')
                  ->comment = 'Primary Key.';

            $table->integer('user_id')
                ->unsigned()
                ->index()
                ->comment = 'Foreign key linking back to a given user in the Users table.';

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
                //->comment = 'Foreign key constraint linking back to the users table.';

            $table->string('company_name',100)
                ->comment = 'Company name where the user has previouly worked';

            $table->date('date_left')
                ->comment = 'Last date of user at a given company';

            $table->string('reason_for_leaving',255)
                ->comment = 'Brief reason why user left the job at given company';

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_work_experiences');
    }
}
