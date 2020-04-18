<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mappings', function (Blueprint $table) { // Table must be removed, no longer needed!
            $table->bigIncrements('id');
            $table->unsignedBigInteger('area_of_life_id')->nullable();
            $table->unsignedBigInteger('symptom_id')->nullable();
            $table->string('name')->nullable();
            $table->string('instant_help')->nullable();
            $table->integer('res_prio')->nullable();
            $table->integer('fear')->nullable();
            $table->integer('anger')->nullable();
            $table->integer('sadness')->nullable();
            $table->string('belief')->nullable();
            $table->string('recom_book_url')->nullable();
            $table->string('recom_book_image')->nullable();
            $table->string('recom_book_description')->nullable();
            $table->string('recom_program')->nullable();
            $table->timestamps();

            $table->foreign('area_of_life_id')->references('id')->on('area_of_lives');
            $table->foreign('symptom_id')->references('id')->on('symptoms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mappings');
    }
}
