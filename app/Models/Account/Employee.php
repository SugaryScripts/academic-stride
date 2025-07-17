<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    /**
     * Get the user that owns the employee.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
