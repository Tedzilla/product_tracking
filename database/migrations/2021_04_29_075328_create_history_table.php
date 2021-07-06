<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('product_id');
            $table->string('data');
            $table->date('created_at');
            $table->tinyInteger('active');
            $table->bigInteger('serial_number');
            $table->bigInteger('artikul_number');
        });
    }
}
