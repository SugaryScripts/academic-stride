<?php

namespace App\Models\Attempt;

use App\Models\Assessment\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionQuestion extends Model {
    use HasFactory;

    protected $fillable = [
        'session_exam_id',
        'question_id',
        'question_order'
    ];

    /**
     * Get the session exam that owns the session question.
     */
    public function sessionExam() {
        return $this->belongsTo(SessionExam::class);
    }

    /**
     * Get the question associated with the session question.
     */
    public function question() {
        return $this->belongsTo(Question::class);
    }

    /**
     * Get the user answer for this session question.
     */
    public function userAnswerTextOption() {
        return $this->hasOne(UserAnswerTextOption::class);
    }

}
