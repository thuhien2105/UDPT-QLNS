<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('activities', function (Blueprint $table) {
        $table->id('activity_id');
        $table->unsignedBigInteger('employee_id');
        $table->string('activity_type');
        $table->float('distance_km');
        $table->integer('duration_minutes');
        $table->date('start_date');
        $table->date('end_date');
        $table->timestamps();

        $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
};