<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            //Info
            $table->string('title', 255)->nullable();
            $table->text('content')->nullable();
            $table->integer('thumb')->nullable();
            $table->string('gallery', 255)->nullable();
            $table->string('video', 255)->nullable();

            //Price
            $table->decimal('price', 12, 2)->nullable();
            $table->bigInteger('parent_id')->nullable();

            $table->smallInteger('number')->nullable();
            $table->tinyInteger('beds')->nullable();
            $table->tinyInteger('size')->nullable();
            $table->tinyInteger('adults')->nullable();
            $table->tinyInteger('children')->nullable();

            //Extra Info
            $table->bigInteger('status')->nullable();
            $table->bigInteger('created_at')->nullable();
            $table->bigInteger('updated_at')->nullable();
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
        Schema::dropIfExists('rooms');
    }
}
