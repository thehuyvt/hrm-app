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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->on('projects')->references('code')->onDelete('cascade');
            $table->foreignId('person_id')->constrained('people', 'id')->onDelete('cascade');
            $table->date('start_time');
            $table->date('end_time');
            $table->smallInteger('priority')->comment("Task Priority Enum")->index();
            $table->string('name', 255);
            $table->text('description');
            $table->smallInteger('status')->comment('Task Status Enum')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
