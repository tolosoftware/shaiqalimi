<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->integer('serial_no')->unique();
            $table->unsignedBigInteger('proposal_id')->nullable();
            $table->date('contract_date');
            $table->date('contract_end_date');
            $table->integer('project_guarantee');
            $table->enum('status', ['A', 'B']);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('proposal_id')->references('id')->on('proposals');
            $table->foreign('user_id')->references('id')->on('users');

            // $table->string('type')->default(1);
            // $table->bigInteger('price')->default(0);
            // $table->bigInteger('duration')->nullable();
            // $table->date('offer_date')->nullable();
            // $table->date('close_date')->nullable();
            // $table->bigInteger('offer_price')->nullable();
            // $table->bigInteger('project_price')->nullable();
            // $table->unsignedBigInteger('announce_id')->nullable();
            // $table->unsignedBigInteger('organization_id')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
