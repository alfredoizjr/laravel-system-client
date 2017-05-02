<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBussinessDirectoryListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bussiness_directory_listings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('login_website',170);
            $table->string('name_listing',170);
            $table->string('email',140)->unique();
            $table->string('password',200);
            $table->string('sucribed',200);
            $table->string('long',200);
            $table->date('expire');
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
        Schema::dropIfExists('bussiness_directory_listings');
    }
}
