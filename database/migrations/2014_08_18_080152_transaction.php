<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial_number');
            $table->enum('currency', ['dolar', 'afg'], true);
            $table->enum('deal_status', ['income', 'simple'], true);
            $table->string('deal_title');
            $table->string('credit');
            $table->string('debit');
            $table->integer('amount');
            $table->text('description');
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
        //
    }
}
