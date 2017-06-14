<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Add some more columns
            $table->string('address_detail');
            $table->string('country');
            $table->string('city')->index();
            $table->string('district')->index();

            $table->timestamps();

        });

        $this->updateTimestampDefaultValue('addresses', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
