<?php

namespace App\Models\Attempt;

use App\Models\Account\User;
use App\Models\Assessment\AnswerTextOption;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswerTextOption extends Model {
    use HasFactory;

    protected $fillable = [
        'session_question_id',
        'user_id',
        'selected_answer_id',
        'is_correct',
    ];

    /**
     * Get the session question that owns the user answer.
     */
    public function sessionQuestion() {
        return $this->belongsTo(SessionQuestion::class);
    }

    /**
     * Get the user that made the answer.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the selected answer option.
     */
    public function selectedAnswer() {
        return $this->belongsTo(AnswerTextOption::class, 'selected_answer_id');
    }
}
