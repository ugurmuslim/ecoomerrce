<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProductSale extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sale', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('product_id');
          $table->integer('product_human_id');
          $table->string('product_name');
          $table->integer('category_id');
          $table->integer('sale_id');
          $table->decimal('sale_price',8,2);
          $table->integer('size_id');
          $table->integer('color_id');
          $table->integer('sale_quantity');
          $table->integer('campaign_id')->nullable();
          $table->integer('payment_id');
          $table->integer('middleman_id')->nullable();
          $table->integer('customer_id')->nullable();
          $table->integer('sale_package');
          $table->integer('seller_id')->nullable();
          $table->boolean('statu')->default(false);
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
        Schema::dropIfExists('product_sale');
    }
}
