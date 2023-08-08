<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('start_point'); //
            $table->string('end_point');
            $table->dateTime('start_time');
            $table->tinyInteger('type')->default(1);
            $table->integer('price');
            $table->integer('fee');
            $table->integer('flight_number');
            $table->tinyInteger('tax')->default(10); //10%
            $table->integer('airline_company_id');
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
        Schema::dropIfExists('tickets');
    }
}
