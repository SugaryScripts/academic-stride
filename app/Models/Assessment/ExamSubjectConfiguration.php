<?php

namespace App\Models\Assessment;

use App\Models\MasterType\RefSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSubjectConfiguration extends Model {
    use HasFactory;

    protected $fillable = [
        'exam_id', 'subject_id',
        'question_count',
        'notes'
    ];

    /**
     * Get the exam that owns the configuration.
     */
    public function exam() {
        return $this->belongsTo(Exam::class);
    }

    /**
     * Get the subject that owns the configuration.
     */
    public function subject() {
        return $this->belongsTo(RefSubject::class, 'subject_id');
    }
}
