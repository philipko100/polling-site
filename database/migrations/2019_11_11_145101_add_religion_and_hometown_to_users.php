<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReligionAndHometownToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->String('hometown_city');
            $table->String('hometown_province');
            $table->String('hometown_country');
            $table->String('religion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('hometown_city');
            $table->dropColumn('hometown_province');
            $table->dropColumn('hometown_country');
            $table->dropColumn('religion');
        });
    }
}
