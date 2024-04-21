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
        Schema::create('project_people', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')
                ->constrained('people', 'id')->onDelete('cascade');
            $table->foreignId('project_code')
                ->constrained('projects', 'code')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_people');
    }
};
