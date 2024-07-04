<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRfqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rfqs', function (Blueprint $table) {
            $table->id();
            $table->integer('importer_id')->nullable();
            $table->integer('produit_id')->nullable();
            $table->integer('entreprise_id')->nullable();
            $table->integer('secteur_id')->nullable();
            $table->integer('longlife')->nullable();
            $table->string('sujet')->nullable();
            $table->text('message')->nullable();
            $table->string('tags')->nullable();
            $table->integer('validation_user')->nullable();
            $table->dateTime('validation_date')->nullable();
            $table->integer('canceled_user')->nullable();
            $table->dateTime('canceled_date')->nullable();
            $table->integer('closed_user')->nullable();
            $table->dateTime('closed_date')->nullable();
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
        Schema::dropIfExists('rfqs');
    }
}
