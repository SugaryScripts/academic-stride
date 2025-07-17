<?php

namespace App\Models\MasterType;

use App\Models\Account\User;
use App\Models\Assessment\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefMasterType extends Model {
    use HasFactory;

    protected $table = 'ref_master_types';
    protected $fillable = [
        'name', 'description', 'code', 'type'
    ];

    /**
     * Get the users that belong to this master type.
     */
    public function users() {
        return $this->hasMany(User::class, 'ref_user_type_id');
    }

    /**
     * Get the questions that belong to this master type (as question type).
     */
    public function questions() {
        return $this->hasMany(Question::class, 'ref_question_type_id');
    }
}
