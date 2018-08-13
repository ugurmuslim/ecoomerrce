<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CretaTableAccountInformations extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('account_informations', function (Blueprint $table) {
      $table->increments('id');
      $table->string('account_name');
      $table->integer('user_id');
      $table->string('first_name');
      $table->string('last_name');
      $table->text('adress')->nullable();
      $table->string('country')->nullable();
      $table->string('city')->nullable();
      $table->string('phone_number')->nullable();
      $table->string('zip_code')->nullable();
      $table->string('id_number')->nullable();
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
    Schema::dropIfExists('account_informations');

  }
}
