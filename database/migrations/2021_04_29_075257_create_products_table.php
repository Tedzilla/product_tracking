<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //if ( !Schema::hasTable('products') ) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->integer('current_number');
                $table->string('name');
                $table->integer('artikul_number')->unique();
                $table->decimal('price_per_piece', 10, 2);
                $table->integer('pieces');
                $table->decimal('package_price', 10, 2);
                $table->timestamps();
                $table->string('status');
                $table->string('state');
            });
        //}
    }

}
