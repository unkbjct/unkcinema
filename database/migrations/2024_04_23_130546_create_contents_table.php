<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->boolean('published')->default(0);
            $table->string('title_rus', 200);
            $table->string('title_eng', 200);
            $table->unsignedBigInteger('type');
            $table->foreign('type')->references('id')->on('types')->onDelete('cascade');
            $table->string('image', 300);
            $table->string('description', 10000)->nullable();
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
        Schema::dropIfExists('contents');
    }
}
