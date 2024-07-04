<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRfqMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rfq_messages', function (Blueprint $table) {
            $table->id();
            $table->integer('rfq_entreprise_id')->nullable();
            $table->integer('rfq_id')->nullable();
            $table->integer('entreprise_id')->nullable();
            $table->boolean('to_importer')->nullable();
            $table->integer('user_id')->nullable();
            $table->text('message')->nullable();
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
        Schema::dropIfExists('rfq_messages');
    }
}
