<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizLettresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_lettres', function (Blueprint $table) {
            $table->id();
            $table->integer('lettre_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('nombre')->nullable();
            $table->integer('correct')->nullable();
            $table->integer('wrong')->nullable();
            $table->integer('pct')->nullable();
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
        Schema::dropIfExists('quiz_lettres');
    }
}
