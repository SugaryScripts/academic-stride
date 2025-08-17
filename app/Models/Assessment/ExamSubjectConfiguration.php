<?php

namespace App\Models\Assessment;

use App\Models\MasterType\RefSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamSubjectConfiguration extends Model {
    use HasFactory;

    protected $fillable = [
        'exam_id', 'ref_subject_id',
        'question_count',
        'notes'
    ];

    /**
     * Get the exam that owns the configuration.
     */
    public function exam(): BelongsTo {
        return $this->belongsTo(Exam::class);
    }

    /**
     * Get the subject that owns the configuration.
     */
    public function subject(): BelongsTo {
        return $this->belongsTo(RefSubject::class, 'ref_subject_id');
    }
}
