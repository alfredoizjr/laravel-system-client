<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTheRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('the_requests', function (Blueprint $table) {
            $table->increments('id');
              $table->string('title',150);
            $table->text('body');
            $table->date('do_date')->nullable();
            $table->string('owner',50);
            $table->integer('user_id')->index();
            $table->string('status')->default('open');
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
        Schema::dropIfExists('the_requests');
    }
}
