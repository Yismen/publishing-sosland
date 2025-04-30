<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Disposition;
use Illuminate\Auth\Access\HandlesAuthorization;

class DispositionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_disposition');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Disposition $disposition): bool
    {
        return $user->can('view_disposition');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_disposition');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Disposition $disposition): bool
    {
        return $user->can('update_disposition');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Disposition $disposition): bool
    {
        return $user->can('delete_disposition');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_disposition');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Disposition $disposition): bool
    {
        return $user->can('force_delete_disposition');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_disposition');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Disposition $disposition): bool
    {
        return $user->can('restore_disposition');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_disposition');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Disposition $disposition): bool
    {
        return $user->can('replicate_disposition');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_disposition');
    }
}
