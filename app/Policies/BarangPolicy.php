<?php

namespace App\Policies;

use App\Models\Barang;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BarangPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('barang.viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Barang $barang): bool
    {
        if ($user->hasRole('admin')) {
            return $user->can('barang.view');
        }

        return $user->can('barang.view') && $barang->gudang_id == $user->gudang_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('barang.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Barang $barang): bool
    {
        if ($user->hasRole('admin')) {
            return $user->can('barang.update');
        }

        return $user->can('barang.update') && $barang->gudang_id == $user->gudang_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Barang $barang): bool
    {
        return $user->hasRole('admin') && $user->can('barang.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Barang $barang): bool
    {
        return $user->can('barang.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Barang $barang): bool
    {
        return $user->can('barang.forceDelete');
    }
}
