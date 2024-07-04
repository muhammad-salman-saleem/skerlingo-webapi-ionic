<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRubriqueQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rubrique_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('rubrique_id')->nullable();
            $table->string('label')->nullable();
            $table->string('type')->nullable();
            $table->string('model')->nullable();
            $table->text('reponses')->nullable();
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
        Schema::dropIfExists('rubrique_questions');
    }
}
