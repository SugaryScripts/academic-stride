<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('user_answer_text_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('session_question_id')->constrained('session_questions')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('selected_answer_id')->constrained('answer_text_options')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean('is_correct')->default(false);
            $table->timestamps();

            $table->unique(['session_question_id', 'user_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('user_answer_text_options');
    }
};
