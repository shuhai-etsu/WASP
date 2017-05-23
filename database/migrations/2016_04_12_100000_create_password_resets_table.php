<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class: CreatePasswordResetsTable
 *
 * Purpose:
 *
 * Notes:
 *
 * @todo - complete class header comments
 *
 * Requirement(s):
 *
 *      Document                            Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 */
class CreatePasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @todo complete this code?  is this really all that's needed?
     *
     * @return void
     */
    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table)
        {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
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
        Schema::drop('password_resets');
    }
}
