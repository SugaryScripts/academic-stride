<?php

namespace App\Models\Assessment;

use App\Models\Account\User;
use App\Models\Attempt\SessionQuestion;
use App\Models\MasterType\RefMasterType;
use App\Models\MasterType\RefSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model {
    use HasFactory;

    protected $fillable = [
        'exam_id', 'subject_id',
        'question_text',
        'ref_subject_code', 'ref_subject_id',
        'ref_question_type_code', 'ref_question_type_id',
        'is_active', 'created_by'
    ];

    /**
     * Get the subject that the question belongs to.
     */
    public function subject() {
        return $this->belongsTo(RefSubject::class, 'ref_subject_id');
    }

    /**
     * Get the question type that the question belongs to.
     */
    public function questionType() {
        return $this->belongsTo(RefMasterType::class, 'ref_question_type_id');
    }

    /**
     * Get the user who created the question.
     */
    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the answer options for the question.
     */
    public function answerTextOptions() {
        return $this->hasMany(AnswerTextOption::class);
    }

    /**
     * Get the session questions for this question.
     */
    public function sessionQuestions() {
        return $this->hasMany(SessionQuestion::class);
    }
}
