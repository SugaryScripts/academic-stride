<?php

namespace App\Models\MasterType;

use App\Models\Account\Student;
use App\Models\Assessment\Exam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefEducation extends Model {
    use HasFactory;

    protected $table = 'ref_educations';
    protected $fillable = [
        'name', 'description', 'code'
    ];

    /**
     * Get the students that belong to this education level.
     */
    public function students() {
        return $this->hasMany(Student::class, 'ref_education_id');
    }

    /**
     * Get the exams that belong to this education level.
     */
    public function exams() {
        return $this->hasMany(Exam::class, 'ref_education_id');
    }
}
