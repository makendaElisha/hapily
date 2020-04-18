<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('customer_id')->nullable();
            $table->float('beruf_und_karriere')->nullable();
            $table->float('partnerschaft')->nullable();
            $table->float('sexualitaet')->nullable();
            $table->float('koerper_und_gesundheit')->nullable();
            $table->float('freundschaften')->nullable();
            $table->float('familie')->nullable();
            $table->float('spiritualitaet')->nullable();
            $table->float('total_areas')->nullable();
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
        Schema::dropIfExists('scores');
    }
}
