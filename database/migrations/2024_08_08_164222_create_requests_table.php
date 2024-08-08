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
    Schema::create('requests', function (Blueprint $table) {
        $table->id('request_id');
        $table->unsignedBigInteger('employee_id');
        $table->string('request_type');
        $table->date('request_date');
        $table->unsignedBigInteger('manager_id');
        $table->timestamps();


        $table->foreign('employee_id', 'custom_foreign_key_name')
        ->references('employee_id')
        ->on('employees')
        ->onDelete('cascade');
        $table->foreign('manager_id')->references('employee_id')->on('employees')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
};