<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('content');
            $table->foreign('content')->references('id')->on('contents')->onDelete('cascade');
            $table->unsignedBigInteger('attribute');
            $table->foreign('attribute')->references('id')->on('attributes')->onDelete('cascade');
            $table->string('value', 200);
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
        Schema::dropIfExists('content_attributes');
    }
}
