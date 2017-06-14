<?php

use Illuminate\Database\Schema\Blueprint;
use \App\Database\Migration;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Add some more columns
            $table->string('res_name', 250)->index()->unique();
            $table->longText('description')->nullable();
            $table->string('opening_hour', 20);
            $table->string('closing_hour', 20);
            $table->boolean('smoking_area');
            $table->longText('note')->nullable();
            $table->string('slug')->default('');
            $table->timestamps();
        });

        $this->updateTimestampDefaultValue('restaurants', ['updated_at'], ['created_at']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
}
