<?php

namespace App\Models\MasterType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubjectProficiencyH extends Model {
    use HasFactory;
    protected $table = 'subject_proficiency_h';
    protected $fillable = [
        'no', 'parameter', 'ref_subject_id'
    ];

    public function details(): HasMany {
        return $this->hasMany(SubjectProficiencyD::class, 'subject_proficiency_h_id');
    }
}
