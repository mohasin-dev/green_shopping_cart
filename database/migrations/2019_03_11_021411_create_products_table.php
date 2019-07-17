<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_title');
            $table->string('product_subtitle')->nullable();
            $table->string('product_slug');
            $table->text('product_short_description')->nullable();
            $table->longText('product_description');
            $table->integer('purchase_price')->nullable();
            $table->integer('regular_price')->nullable();
            $table->integer('sale_price')->default(0);
            $table->integer('stock')->nullable();
            $table->integer('stock_alert')->default(5)->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('hot_product')->default(false);
            $table->boolean('hot_deal')->default(false);
            $table->boolean('special_offer')->default(false);
            $table->boolean('special_deal')->default(false);
            $table->boolean('featured')->default(false);
            $table->boolean('discount')->default(false);
            $table->integer('discount_type')->nullable();
            $table->integer('discount_amount')->default(0)->nullable();
            $table->string('product_image')->default('default.png');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('subcategory_id');
            $table->unsignedInteger('size_id')->nullable();
            $table->unsignedInteger('unit_id')->nullable();
            $table->unsignedBigInteger('added_by');
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade');
            $table->foreign('subcategory_id')
                ->references('id')->on('subcategories')
                ->onDelete('cascade');
            $table->foreign('size_id')
                ->references('id')->on('sizes')
                ->onDelete('cascade');
            $table->foreign('unit_id')
                ->references('id')->on('units')
                ->onDelete('cascade');
            $table->foreign('added_by')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
