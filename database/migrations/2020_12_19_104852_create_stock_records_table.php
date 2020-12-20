<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_records', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->integer('type_id');
            $table->string('source');
            $table->unsignedBigInteger('source_id');
            $table->unsignedBigInteger('item_id');
            $table->decimal('min_increment_uom');
            $table->decimal('min_decrement_uom');
            $table->integer('min_uom_id');
            $table->decimal('increment_sub_uom');
            $table->decimal('decrement_sub_uom');
            $table->unsignedBigInteger('sub_uom_id');
            $table->decimal('density');
            $table->unsignedBigInteger('operation_id');
            $table->string('remark');
            $table->timestamps();

            $table->foreign('operation_id')->references('id')->on('proposals');
            $table->foreign('item_id')->references('id')->on('proposals');
            $table->foreign('sub_uom_id')->references('id')->on('measurment_units');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_records');
    }
}
