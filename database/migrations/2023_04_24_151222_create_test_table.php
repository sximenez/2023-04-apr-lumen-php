<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestTable extends Migration
{
  /**
   * Run the migrations.
   */
  public function up()
  {
    Schema::create('test', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->string('email');
      $table->string('github');
      $table->string('twitter');
      $table->string('location');
      $table->string('latest_article_published');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down()
  {
    Schema::dropIfExists('test');
  }
};
