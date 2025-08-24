<?php

namespace App\Models\Account;

use App\Models\MasterType\RefEducation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model {
    use HasFactory;

    protected $fillable = [
        'ref_education_code', 'ref_education_id',
        'nisn', 'phone', 'user_id'
    ];

    /**
     * Get the education level that the student belongs to.
     */
    public function education() {
        return $this->belongsTo(RefEducation::class, 'ref_education_id');
    }

    /**
     * Get the user that owns the student.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
