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
            $table->integer('proposal_id');
            $table->date('contract_date');
            $table->date('contract_end_date');
            $table->integer('project_guarantee');
            $table->enum('status', ['A', 'B']);
            $table->integer('user_id');
            // $table->string('type')->default(1);
            // $table->bigInteger('price')->default(0);
            // $table->bigInteger('duration')->nullable();
            // $table->date('offer_date')->nullable();
            // $table->date('close_date')->nullable();
            // $table->bigInteger('offer_price')->nullable();
            // $table->bigInteger('project_price')->nullable();
            // $table->unsignedBigInteger('announce_id')->nullable();
            // $table->unsignedBigInteger('organization_id')->nullable();

            // $table->foreign('announce_id')->references('id')->on('announcements');
            // $table->foreign('organization_id')->references('id')->on('organizations');
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
