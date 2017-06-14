<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateResAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('res_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Add some more columns
            $table->bigInteger('restaurant_id')->unsigned()->index();
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');

            $table->bigInteger('address_id')->unsigned()->index();
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');

            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('res_addresses', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('res_addresses');
    }
}
