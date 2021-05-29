<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(array(
            array('id' => '0','name'=>'Admin001','email'=>'admin001@revoir.com','password'=>Hash::make('12345678'),'role_id'=>'1'),
            array('id' => '1','name'=>'Restaurant001','email'=>'restaurant001@revoir.com','password'=>Hash::make('12345678'),'role_id'=>'2'),
            array('id' => '2','name'=>'Reviewer001','email'=>'reviewer001@revoir.com','password'=>Hash::make('12345678'),'role_id'=>'3')
        ));
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
