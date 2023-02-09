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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->string('latitude');
            $table->string('longtitude');
            $table->string('term');
            $table->string('radius');
            $table->string('categories');
            $table->string('locale');
            $table->integer('price');
            $table->boolean('open_now');
            $table->integer('open_at');
            $table->string('attributes');
            $table->string('sort_by');
            $table->string('device_platform');
            $table->date('reservation_date');
            $table->time('reservation_time');
            $table->integer('reservation_covers');
            $table->boolean('matches_party_size_param');
            $table->integer('limit');
            $table->integer('offset');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('businesses');
    }
};