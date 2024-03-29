<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSymptomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('symptoms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('area_of_life_id')->nullable();
            $table->text('name')->nullable();
            $table->text('instant_help')->nullable();
            $table->integer('res_prio')->nullable();
            $table->integer('fear')->nullable();
            $table->integer('anger')->nullable();
            $table->integer('sadness')->nullable();
            $table->string('belief')->nullable();
            $table->text('recom_book_url')->nullable();
            $table->text('recom_book_image')->nullable();
            $table->text('recom_book_description')->nullable();
            $table->text('recom_program_url')->nullable();
            $table->text('recom_program_image')->nullable();
            $table->text('recom_program_description')->nullable();
            $table->timestamps();

            $table->foreign('area_of_life_id')->references('id')->on("area_of_lives");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('symptoms');
    }
}
