<?php

namespace App\Traits;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

trait HasRole
{
    /**
     * Get all User Roles.
     *
     * @return Array
     */
    public function getRoles()
    {
        return $this->roles->lists('name', 'id')->toArray();
    }

    /**
     * Check if user has a specific role
     *
     * @param Role name
     * @return boolean
     */
    public function hasRole($role)
    {
        if (is_string($role))
            return $this->roles->contains('name', $role);

        if ($role instanceof Collection)
        	return !! $role->intersect($this->roles)->count();

        foreach ($role as $r) {
            if ($this->hasRole($r)) return true;
        }

        return false;
    }

    /**
     * Assign role to a user
     *
     * @param App\Models\Role $role
     * @return boolean
     */
    public function assignRole(Role $role)
    {
        if (!$this->hasRole($role->name))
            return $this->roles()->attach($role);
    }

    /**
     * Assign role to a user
     *
     * @param String $name
     * @return boolean
     */
    public function assignRoleByName($name)
    {
        if (!$this->hasRole($name)) {
            return $this->roles()->attach(
                Role::whereName($name)->firstOrFail()
            );
        }
    }

    /**
     * Assign roles to a user
     *
     * @param Array $names
     * @return boolean
     */
    public function assignRolesByName($names)
    {
        foreach ($names as $name) {
            $this->assignRoleByName($name);
        }
    }

    /**
     * Revoke role to a user
     *
     * @param App\Models\Role $role
     * @return boolean
     */
    public function revokeRole(Role $role)
    {
        if ($this->hasRole($role->name))
            return $this->roles()->detach($role);
    }

    /**
     * Revoke role to a user
     *
     * @param String $name
     * @return boolean
     */
    public function revokeRoleByName($name)
    {
        if ($this->hasRole($name)){
            return $this->roles()->detach(
                Role::whereName($name)->firstOrFail()
            );
        }
    }

    /**
     * Revoke roles by name
     *
     * @param Array $names
     * @return boolean
     */
    public function revokeRolesByName($names)
    {
        foreach ($names as $name) {
            $this->revokeRoleByName($name);
        }
    }

    /**
     * Revoke All Roles from User
     *
     * @return boolean
     */
    public function revokeAllRoles()
    {
        return $this->roles()->detach();
    }

    /**
     * Check if user has a specific permission
     *
     * @param Permission name
     * @return boolean
     */
    public function hasPermission($permission)
    {

        if (is_string($permission)){
            foreach ($this->roles() as $role) {
                if ($role->hasPermission($permission)) return true;
            }
        }

        foreach ($permission as $p) {
            if ($this->hasPermission($p)) return true;
        }

        return false;
    }
}