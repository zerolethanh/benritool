<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoneyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->text('shop_name')->nullable();
            $table->text('shop_address')->nullable();
            $table->text('shop_tel')->nullable();
            $table->time('use_time')->nullable();
            $table->date('use_date')->nullable();
            $table->char('use_currency', 3)->nullable();
            $table->dateTime('use_datetime')->nullable();
            $table->double('use_total')->nullable();
            $table->text('read_receipt_data')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('money');
    }
}
