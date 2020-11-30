<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();

            $table->string('s_number')->unique();
            $table->timestamp('issue_date');
            $table->text('issue_address');
            $table->text('source_address');
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->string('title');
            $table->integer('type')->default(1);
            $table->float('duration')->nullable();
            $table->float('price');
            $table->string('auth_number')->nullable();
            $table->timestamp('offer_date')->nullable();
            $table->timestamp('close_date')->nullable();
            $table->float('offer_price')->nullable();
            $table->float('project_price')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('organization_id')->references('id')->on('organizations');
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
        Schema::dropIfExists('announcements');
    }
}
