<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraductionRubriquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traduction_rubriques', function (Blueprint $table) {
            $table->id();
            $table->string('label')->nullable();
            $table->string('alias')->nullable();
            $table->boolean('enable')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('ordre')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('traduction_rubriques');
    }
}
