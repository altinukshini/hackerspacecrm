<?php

namespace App\Traits;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Collection;

trait HasPermission
{
    /**
     * Get all Role Permissions.
     *
     * @return array
     */
    public function getPermissions()
    {
        return $this->permissions->lists('name', 'id')->toArray();
    }

    /**
     * Check if user has a specific permission.
     *
     * @param integer|string|App\Models\Permission|Collection|\Illuminate\Support\Collection|array $permission
     *
     * @return bool
     */
    public function hasPermission($permission)
    {
        if ( is_int($permission) ) {
            return $this->permissions->contains($permission);
        }

        if ( is_string($permission) ) {
            return $this->permissions->contains('name', $permission);
        }

        if ( is_array($permission) ) {
            foreach ($permission as $p) {
                if ( $this->hasPermission($p) ) return true;
            }

            return false;
        }

        if ( $permission instanceof Permission ) {
            return $this->permissions->contains('id', $permission->id);
        }

        if ( $permission instanceof Collection ) {
            return ! ! $permission->intersect($this->permissions)->count();
        }

        return false;
    }

    /**
     * hasPermission() method alias.
     *
     * @param integer|string|App\Models\Permission|Collection|\Illuminate\Support\Collection|array $permissions
     *
     * @return bool
     */
    public function hasPermissions($permissions)
    {
        return $this->hasPermission($permissions);
    }

    /**
     * hasPermission() method alias.
     *
     * @param integer|string|App\Models\Permission|Collection|\Illuminate\Support\Collection|array $permissions
     *
     * @return bool
     */
    public function hasAnyPermission($permissions)
    {
        return $this->hasPermission($permissions);
    }

    /**
     * Determine if the user has all of the given permission(s).
     *
     * @param integer|string|App\Models\Permission|Collection|\Illuminate\Support\Collection|array $permissions
     *
     * @return bool
     */
    public function hasAllPermissions($permissions)
    {
        if ( is_int($permissions) ) {
            return $this->permissions->contains($permissions);
        }

        if ( is_string($permissions) ) {
            return $this->permissions->contains('name', $permissions);
        }

        if ( $permissions instanceof Permission ) {
            return $this->permissions->contains('id', $permissions->id);
        }

        if ( $permissions instanceof Collection ) {
            return ! ! $permissions->intersect($this->permissions)->count();
        }

        $permissions = collect()->make($permissions)->map(function ($permission) {
            return $permission instanceof Permission ? $permission->name : $permission;
        });

        return $permissions->intersect($this->permissions->lists('name')) == $permissions;
    }

    /**
     * Give permission to role.
     *
     * @param integer|string|App\Models\Permission|array $permission
     *
     * @return bool
     */
    public function givePermission($permission)
    {
        // If role has all given permissions
        // just return true, no need to go further...
        if ( $this->hasAllPermissions($permission) ) {
            return true;
        }

        if ( is_integer($permission) ) {
            $existingPermission = Permission::find($permission);
            if ( ! is_null($existingPermission) ) {
                return $this->permissions()->attach($existingPermission);
            }
        }

        if ( is_string($permission) ) {
            $existingPermission = Permission::whereName($permission)->first();
            if ( ! is_null($existingPermission) ) {
                return $this->permissions()->attach($existingPermission);
            }
        }

        if ( $permission instanceof Permission ) {
            return $this->permissions()->attach($permission);
        }

        if ( is_array($permission) ) {
            foreach ($permission as $p) {
                $this->givePermission($p);
            }

            return true;
        }
    }

    /**
     * Give multiple permissions to a role.
     *
     * @param integer|string|App\Models\Permission|array $permissions
     *
     * @return bool
     */
    public function givePermissions($permissions)
    {
        return $this->givePermission($permissions);
    }

    /**
     * Sync Permissions to Role.
     *
     * @param array $permissionIds
     *
     * @return bool
     */
    public function syncPermissions(array $permissionIds)
    {
        return $this->permissions()->sync($permissionIds);
    }

    /**
     * Revoke permission to a role.
     *
     * @param integer|string|App\Models\Permission|array $permission
     *
     * @return bool
     */
    public function revokePermission($permission)
    {
        if ( is_integer($permission) ) {
            $existingPermission = Permission::find($permission);
            if ( ! is_null($existingPermission) && $this->hasPermission($existingPermission) ) {
                return $this->permissions()->detach($existingPermission);
            }
        }

        if ( is_string($permission) ) {
            $existingPermission = Permission::whereName($permission)->first();
            if ( ! is_null($existingPermission) && $this->hasPermission($existingPermission)) {
                return $this->permissions()->detach($existingPermission);
            }
        }

        if ( $permission instanceof Permission ) {
            if ( $this->hasPermission($permission) ) {
                return $this->permissions()->detach($permission);
            }
        }

        if ( is_array($permission) ) {
            foreach ($permission as $p) {
                $this->revokePermission($p);
            }

            return true;
        }

        return false;
    }

    /**
     * Revoke permissions to a role.
     *
     * @param integer|string|App\Models\Permission|array $permissions
     *
     * @return bool
     */
    public function revokePermissions($permissions)
    {
        return $this->revokePermission($permissions);
    }

    /**
     * Revoke All Permissions from Role.
     *
     * @return bool
     */
    public function revokeAllPermissions()
    {
        return $this->permissions()->detach();
    }
}
