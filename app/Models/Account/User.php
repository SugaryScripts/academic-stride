<?php

namespace App\Models\Account;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Assessment\Exam;
use App\Models\Assessment\Question;
use App\Models\Attempt\SessionExam;
use App\Models\Attempt\UserAnswerTextOption;
use App\Models\MasterType\RefMasterType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable {
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guard_name = 'web';
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'user_type_code', 'ref_user_type_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Get the master type that owns the user.
     */
    public function userType() {
        return $this->belongsTo(RefMasterType::class, 'ref_user_type_id');
    }

    /**
     * Get the employee record associated with the user.
     */
    public function employee() {
        return $this->hasOne(Employee::class);
    }

    /**
     * Get the student record associated with the user.
     */
    public function student() {
        return $this->hasOne(Student::class);
    }

    /**
     * Get the exams created by the user.
     */
    public function createdExams() {
        return $this->hasMany(Exam::class, 'created_by');
    }

    /**
     * Get the questions created by the user.
     */
    public function createdQuestions() {
        return $this->hasMany(Question::class, 'created_by');
    }

    /**
     * Get the session exams for the user.
     */
    public function sessionExams() {
        return $this->hasMany(SessionExam::class);
    }

    /**
     * Get the user's answers to questions.
     */
    public function userAnswerTextOptions() {
        return $this->hasMany(UserAnswerTextOption::class);
    }
}
