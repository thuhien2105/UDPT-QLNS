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
        Schema::table('requests', function (Blueprint $table) {
            $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
            $table->foreign('manager_id')->references('employee_id')->on('employees')->onDelete('cascade');
        });

        Schema::table('activities', function (Blueprint $table) {
            $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
        });

        Schema::table('rewards', function (Blueprint $table) {
            $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
            $table->foreign('manager_id')->references('employee_id')->on('employees')->onDelete('cascade');
        });

        Schema::table('vouchers', function (Blueprint $table) {
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
        Schema::table('requests', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
            $table->dropForeign(['manager_id']);
        });

        Schema::table('activities', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
        });

        Schema::table('rewards', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
            $table->dropForeign(['manager_id']);
        });

        Schema::table('vouchers', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
        });
    }
};