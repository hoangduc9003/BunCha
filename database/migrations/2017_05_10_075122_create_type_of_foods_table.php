<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateTypeOfFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_of_foods', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Add some more columns
            $table->string('type_name', 200)->unique();
            $table->string('slug')->default('')->index();
            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('type_of_foods', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_of_foods');
    }
}
