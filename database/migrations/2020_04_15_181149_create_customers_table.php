<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->unsignedBigInteger('survey_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email'); //Make it unique ?
            $table->date('birth');
            $table->string('gender');
            $table->integer('postal_code');
            $table->boolean('haveKids');
            $table->string('time_invest_willingness');
            $table->string('money_invest_willingness');
            $table->boolean('call_opt_in');
            $table->string('phone_number');
            $table->boolean('newsletter_opt_in');
            $table->string('network_id');
            $table->string('submit_date');
            $table->string('start_date');
            $table->string('survey_url');
            $table->string('token');
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
        Schema::dropIfExists('customers');
    }
}
