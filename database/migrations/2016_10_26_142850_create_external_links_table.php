<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExternalLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_links', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login_website',200)->default('http://www.feebee.com');
            $table->string('email',200);
            $table->string('password',200);
            $table->integer('client_id')->index();
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
        Schema::dropIfExists('external_links');
    }
}
