<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('ref_educations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code', 4)->unique();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('ref_subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // science, math, english, etc
            $table->string('code', 10);
            $table->string('description')->nullable();
            $table->foreignId('ref_subject_id')->nullable()
                ->constrained('ref_subjects')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('ref_education_id')
                ->constrained('ref_educations')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('ref_educations');
        Schema::dropIfExists('ref_subjects');
    }
};
