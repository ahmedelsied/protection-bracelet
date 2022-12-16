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
        Schema::create('bracelet_measurements', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('heart_beats_rate');
            $table->unsignedSmallInteger('temperature_rate');
            $table->string('latitude',70);
            $table->string('longitude',70);
            $table->foreignId('bracelet_id')->constrained();
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
        Schema::dropIfExists('bracelet_measurements');
    }
};
