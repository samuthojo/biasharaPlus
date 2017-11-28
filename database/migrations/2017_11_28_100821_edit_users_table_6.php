<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditUsersTable6 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->string('email')->nullable(true)->change();
          $table->string('phone_number')->nullable(true)->change();
          $table->string('image_url')->nullable(true)->change();
          $table->string('subscription_start_date')->nullable(true)->change();
          $table->string('subscription_end_date')->nullable(true)->change();
          $table->string('business_id')->nullable(true)->change();
          $table->string('country')->nullable(true)->change();
          $table->string('username')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
