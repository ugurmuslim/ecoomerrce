<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProductAttributes extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('product_attributes', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('product_id');
      $table->integer('size_id');
      $table->integer('color_id');
      $table->integer('stock');
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
    Schema::dropIfExists('product_attributes');
  }
}
