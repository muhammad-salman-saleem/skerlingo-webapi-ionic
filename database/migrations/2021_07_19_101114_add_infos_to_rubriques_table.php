<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInfosToRubriquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rubriques', function (Blueprint $table) {
            $table->double('time_to_deliver')->nullable();
            $table->double('time_to_deliver_intern')->nullable();
            $table->string('image')->nullable();
            $table->text('presentation')->nullable();
            $table->text('description')->nullable();
            $table->double('montant')->nullable();
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
