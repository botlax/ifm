<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['password']);
        });

        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name',50);
            $table->string('email',100)->unique();
            $table->enum('role',['spectator','god','admin'])->default('god');
            $table->string('password')->nullable();
            $table->rememberToken();
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
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable();
        });

        Schema::dropIfExists('admins');
    }
}
