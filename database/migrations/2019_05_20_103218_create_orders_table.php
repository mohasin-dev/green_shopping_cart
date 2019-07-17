<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                  ->onUpdate('cascade')->onDelete('set null');
            $table->string('name');
            $table->string('email');
            $table->string('address');
            $table->integer('district_id')->unsigned();
            $table->foreign('district_id')->references('id')->on('districts')
                  ->onDelete('cascade');
            $table->integer('upazila_id')->unsigned();
            $table->foreign('upazila_id')->references('id')->on('upazilas')
                  ->onDelete('cascade');
            $table->string('postalcode')->nullable();
            $table->string('phone');
            $table->integer('discount')->default(0);
            $table->integer('custom_discount')->default(0);
            $table->string('discount_code')->nullable();
            $table->integer('subtotal');
            $table->integer('shipping_cost')->nullable();
            $table->integer('total');
            $table->integer('payment_method')->default(1);
            $table->integer('transaction_number')->nullable();
            $table->boolean('seen')->default(false);
            $table->boolean('complete')->default(false);
            $table->boolean('paid')->default(false);
            $table->boolean('shipped')->default(false);
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
}
