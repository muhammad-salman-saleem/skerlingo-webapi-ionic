<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentToRubriquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rubriques', function (Blueprint $table) {
            $table->integer('parent_id')->nullable();
            $table->string('codif')->nullable();
            $table->boolean('show_menu')->nullable();
            $table->boolean('show_calendar')->nullable();
            $table->boolean('first_rubrique')->nullable();
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
        Schema::table('rubriques', function (Blueprint $table) {
            //
        });
    }
}
