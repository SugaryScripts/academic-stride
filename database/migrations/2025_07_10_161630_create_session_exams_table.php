<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('session_exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('exams')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->datetime('started_at');
            $table->datetime('finished_at')->nullable();
            $table->integer('total_score')->default(0);
            $table->integer('total_questions');
            $table->integer('correct_answers')->default(0);
            $table->decimal('percentage_score', 5, 2)->default(0);
            $table->enum('status', ['IN_PROGRESS', 'COMPLETED', 'CLOSED', 'OPEN'])->default('OPEN');
            $table->timestamps();
        });

        Schema::create('session_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_exam_id')->constrained('session_exams')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('question_id')->constrained('questions')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('question_order'); // order of question in exam
            $table->timestamps();

            $table->unique(['session_exam_id', 'question_id'], 'session_question_unique');
        });
    }

    public function down(): void {
        Schema::dropIfExists('session_exams');
        Schema::dropIfExists('session_questions');
    }
};
