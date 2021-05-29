<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_role',50);
            $table->timestamps();
        });
        
        DB::table('roles')->insert(array(
            array('id' => '1','name_role'=>'Admin'),
            array('id' => '2','name_role'=>'Reviewer'),
            array('id' => '3','name_role'=>'Restaurant'),
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('roles');
    }
}
