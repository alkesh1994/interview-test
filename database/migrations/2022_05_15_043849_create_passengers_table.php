<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passengers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('flight_id')->unsigned();
            $table->foreign('flight_id')
                ->references('id')->on('flights')
                ->onDelete('cascade');
            $table->bigInteger('registration_id')->unsigned();
            $table->foreign('registration_id')
                ->references('id')->on('registrations')
                ->onDelete('cascade');
            $table->dateTime('booking_time');
            $table->decimal('paid', 15, 2)->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->integer('status')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('passengers');
    }
}
