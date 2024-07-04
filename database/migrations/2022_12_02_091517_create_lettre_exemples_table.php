<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLettreExemplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lettre_exemples', function (Blueprint $table) {
            $table->id();
            $table->integer('lettre_id')->nullable();
            $table->string('type')->nullable();
            $table->string('kana')->nullable();
            $table->string('romaji')->nullable();
            $table->text('label')->nullable();
            $table->string('prononciation')->nullable();
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
        Schema::dropIfExists('lettre_exemples');
    }
}
