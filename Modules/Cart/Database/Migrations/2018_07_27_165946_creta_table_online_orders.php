<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CretaTableOnlineOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('online_orders', function (Blueprint $table) {
          $table->increments('id');
          $table->bigInteger('basketId');
          $table->integer('product_sale_id')->unsigned();
          $table->integer('sale_package_id')->unsigned();
          $table->integer('customer_id')->unsigned();
          $table->integer('adress_id')->unsigned();
          $table->string('status');
          $table->string('paid');
          $table->text('log');
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
      Schema::dropIfExists('online_orders');

    }
}
