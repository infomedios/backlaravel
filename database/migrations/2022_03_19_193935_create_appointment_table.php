<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('message');
            $table->float('price_expected');
            $table->float('discount');
            $table->string('status');
            $table->timestamp('start_time')->nullable()->default(null);
            $table->timestamp('end_time')->nullable()->default(null);
            $table->bigInteger('person_id')->unsigned();
            $table->foreign('person_id')->references('id')->on('person');
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
        Schema::dropIfExists('appointment');
    }
};
