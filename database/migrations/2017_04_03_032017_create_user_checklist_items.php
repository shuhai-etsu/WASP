<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserChecklistItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_checklist_items', function (Blueprint $table) {
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

            $table->integer('document_id')
                ->unsigned()
                ->index()
                ->comment = 'Foreign key linking back to the checklist_document_types.';

            $table->foreign('document_id')
                ->references('id')
                ->on('checklist_items')
                ->onDelete('cascade')
                ->comment = 'Foreign key constraint linking back to the checklist_items table.';

            $table->date('date_signed')
                ->index()
                ->comment = 'Date the user signed the document.';

            //==========================================================================================================
            //See Considerations section above regarding timestamps and softDeletes
            //==========================================================================================================
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
        Schema::dropIfExists('user_checklist_documents');
    }
}
