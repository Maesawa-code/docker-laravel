<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomingPlansTable extends Migration
{
    public function up()
    {
        Schema::create('incoming_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id');
            $table->integer('product_id');
            $table->date('planned_date');
            $table->integer('quantity');
            $table->float('weight');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('store_id')->references('id')->on('stores');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    public function down()
    {
        Schema::table('incoming_plans', function (Blueprint $table) {
            $table->dropForeign(['store_id']);
            $table->dropForeign(['product_id']);
        });

        Schema::dropIfExists('incoming_plans');
    }
}
