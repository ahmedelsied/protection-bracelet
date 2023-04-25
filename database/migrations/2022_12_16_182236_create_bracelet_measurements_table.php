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
            $table->unsignedSmallInteger('heart_beats_rate')->nullable();
            $table->unsignedSmallInteger('temperature_rate')->nullable();
            $table->string('latitude',70)->nullable();
            $table->string('longitude',70)->nullable();
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
