<?php

namespace App\Models\MasterType;

use App\Models\Assessment\ExamSubjectConfiguration;
use App\Models\Assessment\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefSubject extends Model {
    use HasFactory;

    protected $table = 'ref_subjects';
    protected $fillable = [
        'name', 'description', 'code',
        'ref_education_id'
    ];

    /**
     * Get the education level that this subject belongs to.
     */
    public function education() {
        return $this->belongsTo(RefEducation::class, 'ref_education_id');
    }

    /**
     * Get the exam subject configurations for this subject.
     */
    public function examSubjectConfigurations() {
        return $this->hasMany(ExamSubjectConfiguration::class, 'subject_id');
    }

    /**
     * Get the questions that belong to this subject.
     */
    public function questions() {
        return $this->hasMany(Question::class, 'ref_subject_id');
    }
}
