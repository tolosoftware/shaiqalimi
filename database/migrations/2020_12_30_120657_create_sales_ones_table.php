<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesOnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_ones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_id');
            $table->foreign('sales_id')->references('id')->on('sales');
            $table->integer('serial_no');
            $table->unsignedBigInteger('storage_id');
            $table->foreign('storage_id')->references('id')->on('storages')->onDelete('cascade');
            $table->string('destination');
            $table->decimal('transport_cost');
            $table->decimal('service_cost');
            $table->decimal('tax');
            $table->decimal('deposit');
            $table->decimal('total');
            $table->integer('steps');
            $table->string('description');
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
        Schema::dropIfExists('sales_ones');
    }
}
