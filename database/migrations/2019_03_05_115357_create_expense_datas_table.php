<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenseDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('firm_id');
            $table->integer('type');
            $table->string('kime');
            $table->date('data_date');
            $table->string('detail');
            $table->string('netprice');
            $table->string('tax');
            $table->string('officialprice');
            $table->string('nonofficialprice');
            $table->string('totalprice');
            $table->integer('month_period_id');
            $table->integer('private_period_id');
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
        Schema::dropIfExists('expense_datas');
    }
}
