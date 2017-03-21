<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

trait HasRole
{

    /**
     * Get all User Roles.
     *
     * @return array
     */
    public function getRoles()
    {
        return $this->roles->lists('name', 'id')->toArray();
    }

    /**
     * Check if user has a specific role.
     *
     * @param integer|string|App\Models\Role|Collection|\Illuminate\Support\Collection|array $role
     *
     * @return bool
     */
    public function hasRole($role)
    {
        if (is_int($role)) {
            return $this->roles->contains($role);
        }

        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        if (is_array($role)) {
            foreach ($role as $r) {
                if ($this->hasRole($r)) {
                    return true;
                }
            }

            return false;
        }

        if ($role instanceof Role) {
            return $this->roles->contains('id', $role->id);
        }

        if ($role instanceof Collection) {
            return ! ! $role->intersect($this->roles)->count();
        }

        return false;
    }

    /**
     * hasRole() method alias.
     *
     * @param integer|string|App\Models\Role|Collection|\Illuminate\Support\Collection|array $roles
     *
     * @return bool
     */
    public function hasRoles($roles)
    {
        return $this->hasRole($roles);
    }

    /**
     * hasRole() method alias.
     *
     * @param integer|string|App\Models\Role|Collection|\Illuminate\Support\Collection|array $roles
     *
     * @return bool
     */
    public function hasAnyRole($roles)
    {
        return $this->hasRole($roles);
    }

    /**
     * Determine if the user has all of the given role(s).
     *
     * @param integer|string|App\Models\Role|Collection|\Illuminate\Support\Collection|array $roles
     *
     * @return bool
     */
    public function hasAllRoles($roles)
    {
        if (is_int($roles)) {
            return $this->roles->contains($roles);
        }

        if (is_string($roles)) {
            return $this->roles->contains('name', $roles);
        }

        if ($roles instanceof Role) {
            return $this->roles->contains('id', $roles->id);
        }

        if ($roles instanceof Collection) {
            return ! ! $roles->intersect($this->roles)->count();
        }

        $roles = collect()->make($roles)->map(function ($role) {
            return $role instanceof Role ? $role->name : $role;
        });

        return $roles->intersect($this->roles->lists('name')) == $roles;
    }

    /**
     * Assign roles to a user.
     *
     * @param integer|string|App\Models\Role|array $role
     *
     * @return bool
     */
    public function assignRole($role)
    {
        // If user has all given roles
        // just return true, no need to go further...
        if ($this->hasAllRoles($role)) {
            return true;
        }

        if (is_integer($role)) {
            $existingRole = Role::find($role);
            if (! is_null($existingRole)) {
                return $this->roles()->attach($existingRole);
            }
        }

        if (is_string($role)) {
            $existingRole = Role::whereName($role)->first();
            if (! is_null($existingRole)) {
                return $this->roles()->attach($existingRole);
            }
        }

        if ($role instanceof Role) {
            return $this->roles()->attach($role);
        }

        if (is_array($role)) {
            foreach ($role as $r) {
                $this->assignRole($r);
            }

            return true;
        }
    }

    /**
     * Assign multiple roles to a user.
     *
     * @param integer|string|App\Models\Role|array $roles
     *
     * @return bool
     */
    public function assignRoles($roles)
    {
        return $this->assignRole($roles);
    }

    /**
     * Sync Roles to User.
     *
     * @param array $roleIds
     *
     * @return bool
     */
    public function syncRoles(array $roleIds)
    {
        return $this->roles()->sync($roleIds);
    }

    /**
     * Revoke role to a user.
     *
     * @param integer|string|App\Models\Role|array $role
     *
     * @return bool
     */
    public function revokeRole($role)
    {
        if (is_integer($role)) {
            $existingRole = Role::find($role);
            if (! is_null($existingRole) && $this->hasRole($existingRole)) {
                return $this->roles()->detach($existingRole);
            }
        }

        if (is_string($role)) {
            $existingRole = Role::whereName($role)->first();
            if (! is_null($existingRole) && $this->hasRole($existingRole)) {
                return $this->roles()->detach($existingRole);
            }
        }

        if ($role instanceof Role) {
            if ($this->hasRole($role)) {
                return $this->roles()->detach($role);
            }
        }

        if (is_array($role)) {
            foreach ($role as $r) {
                $this->revokeRole($r);
            }

            return true;
        }

        return false;
    }

    /**
     * Revoke role to a user.
     *
     * @param integer|string|App\Models\Role|array $role
     *
     * @return bool
     */
    public function revokeRoles($roles)
    {
        return $this->revokeRole($roles);
    }

    /**
     * Revoke All Roles from User.
     *
     * @return bool
     */
    public function revokeAllRoles()
    {
        return $this->roles()->detach();
    }

    /**
     * Get all User Permissions.
     *
     * @return array
     */
    public function getPermissions()
    {
        $permissions = [];
        foreach ($this->roles as $role) {
            $permissions += $role->permissions->lists('name', 'id')->toArray();
        }

        return $permissions;
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
        foreach ($this->roles as $role) {
            if ($role->hasPermission($permission)) {
                return true;
            }
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
     * Check if user has all given permissions. You can only give
     * an array of strings as parameter.
     *
     * @param array of strings $permissions
     *
     * @return bool
     */
    public function hasAllPermissions($permissions)
    {
        if (is_array($permissions)) {
            $userPermissions = new Collection([]);
            foreach ($this->roles as $role) {
                $userPermissions = $userPermissions->merge($role->permissions);
            }

            return ! count(array_diff($permissions, $userPermissions->lists('name')->toArray()));
        }

        return $this->hasPermission($permissions);
    }
}
