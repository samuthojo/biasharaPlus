<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('business_id'); //like account number
            $table->string('name');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('password');
            $table->string('subscription')->nullable();
            $table->date('subscription_start_date');
            $table->date('subscription_end_date');
            $table->double('total_cc', 17, 3)->nullable();
            $table->string('country');
            $table->string('image');
            $table->rememberToken();
            $table->timestamps(); //created_at == reg_date
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
