<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee_task',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('assigned_to');
            $table->unsignedBigInteger('assigned_by');
            $table->unsignedBigInteger('task_id');
            $table->timestamps();

            $table->foreign('assigned_to')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('assigned_by')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_task');
    }
};
