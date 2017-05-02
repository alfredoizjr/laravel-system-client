<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('business_name',150);
            $table->string('business_phone',25);
            $table->string('business_email',100)->unique();
            $table->string('business_account',20);
            $table->string('name',100);
            $table->string('Last',100);
            $table->string('status',2)->default('p');
            $table->integer('user_id')->index();
            $table->string('business_address');
            $table->string('business_zip',6);
            $table->string('state',10);
            $table->string('avatar',100)->default('profile.png');
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
        Schema::dropIfExists('clients');
    }
}
