<?php

namespace App\Policies;

use App\Models\Account\User;
use App\Models\SubjectProficiency;
use Illuminate\Auth\Access\Response;

class SubjectProficiencyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SubjectProficiency $subjectProficiency): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SubjectProficiency $subjectProficiency): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SubjectProficiency $subjectProficiency): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SubjectProficiency $subjectProficiency): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SubjectProficiency $subjectProficiency): bool
    {
        return false;
    }
}
