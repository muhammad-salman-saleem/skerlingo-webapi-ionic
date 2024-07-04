<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->integer('marque_id')->nullable();
            $table->string('label')->nullable();
            $table->string('introduction')->nullable();
            $table->string('details')->nullable();
            $table->string('image')->nullable();
            $table->integer('views')->nullable();
            $table->integer('validation_entreprise_user')->nullable();
            $table->dateTime('validation_entreprise_date')->nullable();
            $table->integer('validation_skerlingo_user')->nullable();
            $table->dateTime('validation_skerlingo_date')->nullable();
            $table->integer('creation_user')->nullable();
            $table->integer('secteur_id')->nullable();
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
        Schema::dropIfExists('produits');
    }
}
