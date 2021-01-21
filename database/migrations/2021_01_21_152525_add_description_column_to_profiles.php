<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptionColumnToProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->text('description')->after('country');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            Schema::dropIfExists('description');
        });
    }
}
