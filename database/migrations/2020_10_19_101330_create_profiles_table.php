<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->text('f_name');
            $table->text('l_name');
            $table->string('u_mail')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->date('dob');
            $table->string('sex');
            $table->text('city');
            $table->string('country');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('pp')->nullable();
            $table->string('cp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
