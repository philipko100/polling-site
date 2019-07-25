<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddManyAdditionFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ( $table) {
            $table->date('birth_date');
            $table->string('gender');
            $table->string('current_city');
            $table->string('current_province');
            $table->string('current_country');
            $table->string('occupation')->default('No info given');
            $table->string('income_level')->default('No info given');
            $table->string('education_level')->default('No info given');
            $table->string('race_origin')->default('No info given');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ( $table) {
            $table->dropColumn('birth_date');
            $table->dropColumn('gender');
            $table->dropColumn('current_city');
            $table->dropColumn('current_province');
            $table->dropColumn('current_country');
            $table->dropColumn('occupation');
            $table->dropColumn('income_level');
            $table->dropColumn('education_level');
            $table->dropColumn('race_origin');
        });
    }
}
