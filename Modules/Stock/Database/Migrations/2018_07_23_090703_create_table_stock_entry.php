<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStockEntry extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('stock_entry', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('stock_movement_type_id');
      $table->integer('product_id');
      $table->integer('category_id');
      $table->integer('size_id');
      $table->integer('color_id');
      $table->decimal('entry_price',8,2);
      $table->integer('quantity');
      $table->integer('price');
      $table->integer('vendor_id')->nullable();
      $table->integer('package');
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
    Schema::dropIfExists('stock_entry');
  }
}
