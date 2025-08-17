<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();

            $table->integer('total_questions')->default(40); // limit questions per exam
            $table->integer('duration_minutes')->default(120); // exam duration
            //$table->datetime('start_time');
            //$table->datetime('end_time');

            $table->string('ref_education_code');
            $table->foreignId('ref_education_id')->constrained('ref_educations')
                ->cascadeOnUpdate()->restrictOnDelete();

            $table->foreignId('created_by')->constrained('users') // educator who created
                ->cascadeOnUpdate()->nullOnDelete();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('exam_subject_configurations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('exams')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('ref_subject_id')->constrained('ref_subjects')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('question_count'); // e.g., 10 questions for science, 15 for math
            $table->text('notes')->nullable(); // additional notes about this subject in exam
            $table->timestamps();

            $table->unique(['exam_id', 'ref_subject_id'], 'exam_subject_unique');
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('question_text');

            $table->string('ref_subject_code');
            $table->foreignId('ref_subject_id')->constrained('ref_subjects')
                ->cascadeOnUpdate()->restrictOnDelete();
            $table->string('ref_question_type_code');
            $table->foreignId('ref_question_type_id')
                ->constrained('ref_master_types', 'id')
                ->cascadeOnUpdate()->restrictOnDelete();

            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->constrained('users')
                ->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
        });


        // TODO: created by?
        Schema::create('subject_proficiency_h', function (Blueprint $table) {
            $table->id();
            $table->integer('no');
            $table->string('parameter');
            $table->foreignId('ref_subject_id')->constrained('ref_subjects')
                ->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();
        });
        Schema::create('subject_proficiency_d', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')
                ->constrained('questions')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('subject_proficiency_h_id')
                ->constrained('subject_proficiency_h')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('exams');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('exam_subject_configurations');
        Schema::dropIfExists('subject_proficiency_h');
        Schema::dropIfExists('subject_proficiency_d');
    }
};
