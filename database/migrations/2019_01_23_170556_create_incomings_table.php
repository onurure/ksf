<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('firm_id');
            $table->integer('type');
            $table->integer('customer_id');
            $table->string('project');
            $table->date('data_date');
            $table->string('detail');
            $table->string('billno');
            $table->string('safe_id');
            $table->string('netprice');
            $table->string('tax');
            $table->string('officialprice');
            $table->string('nonofficialprice');
            $table->string('totalprice');
            $table->integer('month_period_id');
            $table->integer('private_period_id');
            $table->integer('safe_data_id')->nullable();
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
        Schema::dropIfExists('incomings');
    }
}
