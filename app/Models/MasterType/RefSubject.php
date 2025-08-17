<?php

namespace App\Models\MasterType;

use App\Models\Assessment\ExamSubjectConfiguration;
use App\Models\Assessment\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RefSubject extends Model {
    use HasFactory;

    protected $table = 'ref_subjects';
    protected $fillable = [
        'name', 'description', 'code',
        'ref_education_id',
        'ref_subject_id'
    ];

    public function parent(): BelongsTo {
        return $this->belongsTo(RefSubject::class, 'ref_subject_id');
    }

    public function children(): HasMany {
        return $this->hasMany(RefSubject::class, 'ref_subject_id');
    }

    public function subjectProficiencyH(): HasMany {
        return $this->hasMany(SubjectProficiencyH::class, 'ref_subject_id');
    }

    /**
     * Get the education level that this subject belongs to.
     */
    public function education(): BelongsTo {
        return $this->belongsTo(RefEducation::class, 'ref_education_id');
    }

    /**
     * Get the exam subject configurations for this subject.
     */
    public function examSubjectConfigurations(): HasMany {
        return $this->hasMany(ExamSubjectConfiguration::class, 'ref_subject_id');
    }

    /**
     * Get the questions that belong to this subject.
     */
    public function questions(): HasMany {
        return $this->hasMany(Question::class, 'ref_subject_id');
    }
}
