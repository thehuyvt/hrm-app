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
        Schema::create('departments', function (Blueprint $table) {
            $table->string('code', 10)->primary();
            $table->string('name', 80);
            $table->string('parent_id')->nullable();
            $table->foreign('parent_id')->references('code')->on('departments')->onDelete('cascade');
            $table->foreignId('company_id')->constrained('companies', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
