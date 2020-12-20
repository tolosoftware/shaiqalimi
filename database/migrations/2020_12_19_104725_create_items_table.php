<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id');
            $table->string('name');
            $table->unsignedBigInteger('min_uom_id');
            $table->unsignedBigInteger('sub_oum_id');
            $table->integer('unit_equivalent');
            $table->text('description');
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('item_types');
            $table->foreign('min_uom_id')->references('id')->on('measurment_units');
            $table->foreign('sub_oum_id')->references('id')->on('proposals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
