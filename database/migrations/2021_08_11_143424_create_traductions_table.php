<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traductions', function (Blueprint $table) {
            $table->id();
            $table->string('label')->nullable();
            $table->string('alias')->nullable();
            $table->string('type')->nullable();
            $table->text('value')->nullable();
            $table->boolean('enable')->nullable();
            $table->integer('rubrique_id')->nullable();
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
        Schema::dropIfExists('traductions');
    }
}
