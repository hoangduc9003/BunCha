<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateResTypeOfFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('res_type_of_foods', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Add some more columns

            $table->bigInteger('restaurant_id')->unsigned()->index();
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->bigInteger('food_type_id')->unsigned()->index();
            $table->foreign('food_type_id')->references('id')->on('type_of_foods')->onDelete('cascade');

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('res_type_of_foods', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('res_type_of_foods');
    }
}
