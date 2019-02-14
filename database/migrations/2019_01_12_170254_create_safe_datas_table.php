<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSafeDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('safe_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('safe_account_id');
            $table->date('data_date');
            $table->string('banknote');
            $table->string('detailnote');
            $table->string('project');
            $table->integer('incoming');
            $table->integer('outgoing');
            $table->integer('tax');
            $table->integer('main_class_id');
            $table->integer('sub_class_id');
            $table->integer('month_period_id');
            $table->integer('private_period_id');
            $table->tinyInteger('approve');
            $table->integer('approved_by');
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
        Schema::dropIfExists('safe_datas');
    }
}
