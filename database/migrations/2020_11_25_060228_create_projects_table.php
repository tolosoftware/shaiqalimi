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

            $table->integer('s_number')->unique();
            $table->date('issue_date');
            $table->text('issue_address');
            $table->text('source_address');
            $table->string('title');
            $table->string('img')->nullable();
            $table->string('auth_number')->nullable();
            $table->string('type')->default(1);
            $table->float('price')->default(0);
            $table->float('duration')->nullable();
            $table->date('offer_date')->nullable();
            $table->date('close_date')->nullable();
            $table->float('offer_price')->nullable();
            $table->float('project_price')->nullable();
            $table->unsignedBigInteger('announce_id')->nullable();
            $table->unsignedBigInteger('organization_id')->nullable();
            
            $table->foreign('announce_id')->references('id')->on('announcements');
            $table->foreign('organization_id')->references('id')->on('organizations');
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
