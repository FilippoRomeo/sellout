<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisement_models', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->integer("mainCategoryId");
            $table->integer("subCategoryId");
            $table->string("productName");
            $table->integer("purchaseYear");
            $table->integer("expSellPrice");
            $table->string("name");
            $table->string("mobile");
            $table->string("email");
            $table->string("state");
            $table->string("city");
            $table->text("photos");
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
        Schema::dropIfExists('advertisement_models');
    }
}
