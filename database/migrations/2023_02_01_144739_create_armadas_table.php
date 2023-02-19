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
        Schema::create('armadas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->enum('type' , ['car','motorcycle']);
            $table->integer('seat')->nullable();
            $table->integer('luggage')->nullable();
            $table->enum('transmission',['manual','automatic','cvt','mt']);
            $table->string('fuel')->default('petrol');
            $table->integer('price_hour');
            $table->integer('price_day');
            $table->integer('price_otherlocation');
            $table->integer('price_withdriver');
            $table->string('stock')->default(1);
            $table->string('used')->default(0);
            $table->text('description');
            $table->text('images');
            $table->string('thumbnail');
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
        Schema::dropIfExists('armadas');
    }
};
