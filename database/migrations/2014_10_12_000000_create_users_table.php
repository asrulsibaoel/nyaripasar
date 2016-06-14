<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->string('name', 64);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->integer('lapak_id')->length(12)->nullable();
            $table->foreign('lapak_id')
                ->references('id')->on('lapak');
            $table->text('description')->nullable();
            $table->enum('role', ['admin', 'pelapak', 'government', 'customer']);
            $table->date('registered_date');
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
        Schema::drop('users');
    }
}
