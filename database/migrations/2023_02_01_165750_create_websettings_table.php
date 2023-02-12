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
        Schema::create('websettings', function (Blueprint $table) {
            $table->string('title');
            $table->string('icon');
            $table->string('name');
            $table->string('meta_author');
            $table->text('meta_description');
            $table->text('meta_keywords');
            $table->text('terms');
            $table->text('privacy_policy');
            $table->text('about');
            $table->text('gmaps_url');
            $table->text('address');
            $table->string('email');
            $table->string('phone');
            $table->string('office_phone');
            $table->string('fb_url');
            $table->string('ig_url');
            $table->string('tiktok_url');
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
        Schema::dropIfExists('websettings');
    }
};
