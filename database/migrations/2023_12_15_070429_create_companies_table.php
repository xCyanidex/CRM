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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name', 50);
            $table->string('business_type', 50);
            $table->string('industry', 50);
            $table->bigInteger('registration_number');
            $table->string('website')->nullable();
            $table->string('logo')->nullable();
            $table->unsignedBigInteger('entity_id');
            $table->string('entity_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
