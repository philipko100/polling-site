<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBioAndSelfIdentifiedPoliticalPositionToFigures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('figures', function ( $table) {
            $table->mediumText('bio');
            $table->string('self_position');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('figures', function ( $table) {
            $table->dropColumn('bio');
            $table->dropColumn('self_position');
        });
    }
}
