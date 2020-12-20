<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pro_data', function (Blueprint $table) {
            $table->id();
            $table->integer('proposal_id');
            $table->integer('project_id');
            $table->integer('client_id');
            $table->string('title');
            $table->string('reference_no');
            $table->integer('pr_worth');
            $table->integer('deposit');
            $table->integer('tax');
            $table->integer('transit');
            $table->integer('others');
            $table->integer('currency_id');
            $table->integer('total_price');
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
        Schema::dropIfExists('pro_data');
    }
}
