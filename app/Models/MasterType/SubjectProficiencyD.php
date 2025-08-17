<?php

namespace App\Models\MasterType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubjectProficiencyD extends Model {
    use HasFactory;
    protected $table = 'subject_proficiency_d';
    protected $fillable = [
        'question_id', 'subject_proficiency_h_id',
    ];

    public function header(): BelongsTo {
        return $this->belongsTo(SubjectProficiencyH::class, 'subject_proficiency_h_id');
    }
}
