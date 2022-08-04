<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history', function (Blueprint $table) {
            $table->id();
            $table->string('action')->nullable(false)->index();
            $table->string('table')->nullable(false)->index();
            $table->string('model')->nullable(false)->index();
            $table->integer('model_id')->nullable(false);
            $table->string('column')->nullable(true);
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
            $table->integer('user_id')->nullable(true)->index();
            $table->string('ip_address')->nullable(false);
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
        Schema::dropIfExists('history');
    }
}
