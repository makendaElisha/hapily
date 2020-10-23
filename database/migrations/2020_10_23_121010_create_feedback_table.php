<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_id');
            $table->string('token');
            $table->boolean('option1')->default(false);
            $table->boolean('option2')->default(false);
            $table->boolean('option3')->default(false);
            $table->boolean('option4')->default(false);
            $table->boolean('option5')->default(false);
            $table->boolean('option6')->default(false);
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
        Schema::dropIfExists('feedback');
    }
}
