<?php

namespace App\Policies;

use App\Models\AcademicYear;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AcademicYearPolicy
{
    use HandlesAuthorization;

    /**
    // public function viewAny(User $user)
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can view the model.
    //  *
    //  * @param  \App\Models\User  $user
    //  * @param  \App\Models\AcademicYear  $academicYear
    //  * @return \Illuminate\Auth\Access\Response|bool
    //  */
    // public function view(User $user, AcademicYear $academicYear)
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can create models.
    //  *
    //  * @param  \App\Models\User  $user
    //  * @return \Illuminate\Auth\Access\Response|bool
    //  */
    public function create(User $user)
    {
        return true;
    }

    // /**
    //  * Determine whether the user can update the model.
    //  *
    //  * @param  \App\Models\User  $user
    //  * @param  \App\Models\AcademicYear  $academicYear
    //  * @return \Illuminate\Auth\Access\Response|bool
    //  */
    // public function update(User $user, AcademicYear $academicYear)
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can delete the model.
    //  *
    //  * @param  \App\Models\User  $user
    //  * @param  \App\Models\AcademicYear  $academicYear
    //  * @return \Illuminate\Auth\Access\Response|bool
    //  */
    // public function delete(User $user, AcademicYear $academicYear)
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can restore the model.
    //  *
    //  * @param  \App\Models\User  $user
    //  * @param  \App\Models\AcademicYear  $academicYear
    //  * @return \Illuminate\Auth\Access\Response|bool
    //  */
    // public function restore(User $user, AcademicYear $academicYear)
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  *
    //  * @param  \App\Models\User  $user
    //  * @param  \App\Models\AcademicYear  $academicYear
    //  * @return \Illuminate\Auth\Access\Response|bool
    //  */
    // public function forceDelete(User $user, AcademicYear $academicYear)
    // {
    //     //
    // }
}
