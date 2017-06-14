<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMailConfirmationUserRegisteration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin_users', function (Blueprint $table) {
            //
            $table->tinyInteger('verified')->default(0)->after('password');
            $table->string('email_token')->nullable()->after('verified');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_users', function (Blueprint $table) {
            //
            $table->dropColumn('verified');
            $table->dropColumn('email_token');
        });
    }
}
