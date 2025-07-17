<?php

namespace App\Models\Assessment;

use App\Models\Account\User;
use App\Models\Attempt\SessionExam;
use App\Models\MasterType\RefEducation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model {
    use HasFactory;

    protected $fillable = [
        'title', 'description',
        'total_questions', 'duration_minutes',
        'ref_education_code', 'ref_education_id',
        'created_by', 'is_active'
    ];

    /**
     * Get the education level that the exam belongs to.
     */
    public function education() {
        return $this->belongsTo(RefEducation::class, 'ref_education_id');
    }

    /**
     * Get the user who created the exam.
     */
    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the subject configurations for the exam.
     */
    public function subjectConfigurations() {
        return $this->hasMany(ExamSubjectConfiguration::class);
    }

    /**
     * Get the session exams for this exam.
     */
    public function sessionExams() {
        return $this->hasMany(SessionExam::class);
    }
}
