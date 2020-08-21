<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPropertyGroupTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pro_pro_gr_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pro_pro_gr_id');
            $table->string('locale')->index();
            $table->string('name');

            $table->timestamps();

            $table->unique(['pro_pro_gr_id', 'locale']);
            $table->foreign('pro_pro_gr_id')->references('id')->on('pro_pro_gr')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pro_pro_gr_translations');
    }
}
