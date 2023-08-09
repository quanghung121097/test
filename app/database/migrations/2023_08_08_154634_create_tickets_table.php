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
            $table->integer('start_location'); //
            $table->integer('end_location');
            $table->date('start_time');
            $table->tinyInteger('type_id')->default(1);
            $table->integer('price');
            $table->integer('fee');
            $table->integer('flight_number');
            $table->tinyInteger('tax')->default(10); //10%
            $table->integer('airline_company_id');
            $table->timestamps();
            $table->softDeletes();
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
