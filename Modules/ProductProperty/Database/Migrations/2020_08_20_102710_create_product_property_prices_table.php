<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPropertyPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pro_pro_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('properties');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('pro_pro_gr')->onDelete('cascade');
            $table->double('price');
            $table->string('sku');
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
        Schema::dropIfExists('pro_pro_prices');
    }
}
