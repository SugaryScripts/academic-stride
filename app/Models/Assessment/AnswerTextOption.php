<?php

namespace App\Models\Assessment;

use App\Models\Attempt\UserAnswerTextOption;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerTextOption extends Model {
    use HasFactory;

    protected $fillable = [
        'question_id',
        'answer',
        'is_correct'
    ];

    /**
     * Get the question that owns the answer option.
     */
    public function question() {
        return $this->belongsTo(Question::class);
    }

    /**
     * Get the user answers that selected this option.
     */
    public function userAnswerTextOptions() {
        return $this->hasMany(UserAnswerTextOption::class, 'selected_answer_id');
    }
}
