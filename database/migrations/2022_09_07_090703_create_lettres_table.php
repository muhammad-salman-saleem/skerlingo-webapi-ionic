<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLettresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('lettres', function (Blueprint $table) {
            $table->id();
            $table->integer('lecon_id')->nullable();
            $table->string('type')->nullable();
            $table->string('romaji')->nullable();
            $table->string('kana')->nullable();
            $table->string('label')->nullable();
            $table->string('stars')->nullable();
            $table->string('stroke')->nullable();
            $table->string('number')->nullable();
            $table->string('prononciation')->nullable();
            $table->string('illustration')->nullable();
            $table->string('illustration_letter')->nullable();
            $table->string('color')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('lettres');
    }
}
