<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extras', function (Blueprint $table) {
          $table->increments('id');
          $table->string('web_url',255);
          $table->string('hosting_info',150);
          $table->string('hosting_user',150);
          $table->string('hosting_password',200);
          $table->integer('client_id')->index();
          $table->string('Cpanel',100)->nullable();
          $table->string('Cpanel_password',100)->nullable();
          $table->string('email_one',100)->nullable();
          $table->string('email_two',100)->nullable();
          $table->string('email_password',100)->nullable();
          $table->string('pin',100)->nullable();
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
        Schema::dropIfExists('extras');
    }
}
