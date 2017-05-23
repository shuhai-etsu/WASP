<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateConstraintsTable
 *
 * @todo - create class header documentation
 *
 */
class CreateConstraintsTable extends Migration
{
    /**
     * Run the migrations (e.g. creates the table and initializes its constraints).
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constraints', function (Blueprint $table) {
            $table->increments('id')
                  ->comment = 'Primary Key';

            $table->string('abbreviation', 15)
                ->unique()
                ->comment = 'Abbreviation of a given constraint entry, such as IO for Infant only.';

            $table->string('description', 50)
                ->unique()
                ->comment = 'Description of a given constraint entry, such as Infant Only.';

            $table->string('comment', 255)
                ->nullable()
                ->comment = 'Brief comment about the given constraint entry.';

            $table->boolean('enabled')
                ->default(true)
                ->comment = 'Determines if the entry enabled or disabled.';

            $table->boolean('default_selection')
                ->default(false)
                ->comment = 'Determines if the entry should be shown as the default selection in UI controls.';

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
        Schema::dropIfExists('constraints');
    }
}
