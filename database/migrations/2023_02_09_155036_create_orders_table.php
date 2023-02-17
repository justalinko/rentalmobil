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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('armada_id');
            $table->string('booking_code');
            $table->enum('customer_type' , ['user' , 'agent'])->default('user');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->enum('contact_type' , ['whatsapp' , 'telegram'])->default('whatsapp');
            $table->string('contact_id')->nullable();
            $table->string('service_type')->nullable();
            $table->enum('pickup_type' , ['office' , 'other_location'])->default('office');
            $table->text('pickup_address')->nullable();
            $table->enum('dropoff_type' , ['office' , 'other_location'])->default('office');
            $table->text('dropoff_adress')->nullable();
            $table->string('start_date');
            $table->string('end_date');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('total_price');
            $table->text('note')->default('-');
            $table->string('payment_method')->nullable();
            $table->enum('status' , ['waiting_payment' ,'waiting_confirmation' ,'waiting_pickup' , 'confirmed' ,'on_going' ,'cancelled' , 'finished'])->default('waiting_payment');
            $table->text('additional_input')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
