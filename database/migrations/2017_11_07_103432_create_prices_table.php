<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('price_list_id')->unsigned();
            $table->bigInteger('price')->default(0);
            $table->bigInteger('tanzania')->default(0);
            $table->bigInteger('kenya')->default(0);
            $table->bigInteger('uganda')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('product_id')
                  ->references('id')
                  ->on('products');
            $table->foreign('price_list_id')
                  ->references('id')
                  ->on('price_lists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prices');
    }
}
