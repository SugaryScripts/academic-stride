<?php

namespace App\Models\Attempt;

use App\Models\Account\User;
use App\Models\Assessment\Exam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionExam extends Model {
    use HasFactory;

    // $sessionStatuses = ['IN_PROGRESS', 'COMPLETED', 'CLOSED', 'OPEN'];
    protected $fillable = [
        'id',
        'exam_id',
        'user_id',
        'started_at',
        'estimated_finished_at',
        'finished_at',
        'total_score',
        'total_questions',
        'correct_answers',
        'percentage_score',
        'status',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'estimated_finished_at' => 'datetime',
        'finished_at' => 'datetime',
        'percentage_score' => 'decimal:2',
    ];

    /**
     * Get the exam that owns the session.
     */
    public function exam() {
        return $this->belongsTo(Exam::class);
    }

    /**
     * Get the user that owns the session.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the session questions for this session exam.
     */
    public function sessionQuestions() {
        return $this->hasMany(SessionQuestion::class);
    }
}
