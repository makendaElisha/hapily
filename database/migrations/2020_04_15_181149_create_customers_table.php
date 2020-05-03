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
            $table->string('prename')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable(); //Make it unique ?
            $table->date('birth')->nullable();
            $table->string('gender')->nullable();
            $table->integer('postal_code')->nullable();
            $table->string('time_invest_willingness')->nullable();
            $table->string('money_invest_willingness')->nullable();
            $table->boolean('call_opt_in')->nullable();
            $table->string('phone_number')->nullable();
            $table->boolean('newsletter_opt_in')->nullable();
            $table->string('network_id')->nullable();
            $table->string('submit_date')->nullable();
            $table->string('start_date')->nullable();
            $table->string('survey_url')->nullable();
            $table->string('token')->nullable();
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
