<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookCollectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_collection', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('book')->unsigned();
            $table->integer('collection')->unsigned();
            $table->foreign('book')->references('id')->on('books');
            $table->foreign('collection')->references('id')->on('collections');
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
        Schema::dropIfExists('book_collection');
    }
}
