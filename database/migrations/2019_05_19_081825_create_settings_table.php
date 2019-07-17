<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name')->nullable();
            $table->string('email1')->nullable();
            $table->string('email2')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('mobile_number1')->nullable();
            $table->string('mobile_number2')->nullable();
            $table->string('logo')->nullable();
            $table->text('live_news')->nullable();
            $table->string('favicon')->nullable();
            $table->string('shipping_cost')->nullable();
            $table->string('banner1')->nullable();
            $table->string('banner2')->nullable();
            $table->string('banner3')->nullable();
            $table->string('banner4')->nullable();
            $table->string('banner5')->nullable();
            $table->string('banner6')->nullable();
            $table->string('banner7')->nullable();
            $table->string('banner8')->nullable();
            $table->string('banner9')->nullable();
            $table->string('banner10')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
