<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('restaurant_Name',255);
            $table->string('detail',500);
            $table->string('phone');
            $table->mediumText('photo')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('status_approve');
            $table->string('status_active');
            $table->timestamps();
        });

        DB::table('restaurants')->insert(array(
            array('id' => '0','restaurant_Name'=>'ร้านค้า Restaurant Tester001','detail'=>'ทดสอบการรีวิวร้านค้า','phone'=>'090-123-5555','photo'=>'testRestaurant.jpg','user_id'=>'2','status_approve'=>false,'status_active'=>false)
            
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('restaurants');
    }
}
