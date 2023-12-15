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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name');
          //  $table->unsignedBigInteger('user_id');
            $table->string('phone_number');
            $table->date('dob');
            $table->enum('gender',['male','female','other']);

            $table->timestamps();

        //    $table->foreign('user_id')->references('id')->on('User')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
