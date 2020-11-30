<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('deal_serial_number');
            $table->enum('deal_currency', ['dolar', 'afghani'], true);
            $table->string('deal_amount');
            $table->enum('deal_status', ['income', 'normal'], true);
            $table->string('deal_date');
            $table->string('deal_title');
            $table->string('deal_debit_account');
            $table->text('deal_dbt_acnt_desc');
            $table->string('deal_credit_account');
            $table->text('deal_crdt_acnt_desc');
            $table->text('deal_description');
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
