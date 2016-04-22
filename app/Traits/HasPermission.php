<?php

namespace App\Traits;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Collection;

trait HasPermission
{

    /**
     * Get all Role Permissions.
     *
     * @return Array
     */
    public function getPermissions()
    {
        return $this->permissions->lists('name', 'id')->toArray();
    }

    /**
     * Check if user has a specific role
     *
     * @param Role name
     * @return boolean
     */
    public function hasPermission($permission)
    {
        if (is_string($permission))
            return $this->permissions->contains('name', $permission);

        if ($permission instanceof Collection)
        	return !! $permission->intersect($this->permissions)->count();

        foreach ($permission as $p) {
            if ($this->hasPermission($p)) return true;
        }

        return false;
    }

	/**
     * Give permission to role
     *
     * @param App\Models\Permission $permission
     * @return boolean
     */
    public function givePermission(Permission $permission)
    {
        if (!$this->hasPermission($permission->name))
            return $this->permissions()->attach($permission);
    }

    /**
     * Give Permission to Role
     *
     * @param String $name
     * @return boolean
     */
    public function givePermissionByName($name)
    {
        if (!$this->hasPemrission($name)) {
            return $this->pemrissions()->attach(
                Permission::whereName($name)->firstOrFail()
            );
        }
    }

    /**
     * Give Permissions by name
     *
     * @param Array $names
     * @return boolean
     */
    public function givePermissionsByName($name)
    {
        foreach ($names as $name) {
            $this->givePermissionByName($name);
        }
    }

    /**
     * Revoke Permission to Role
     *
     * @param App\Models\Permission $permission
     * @return boolean
     */
    public function revokePermission(Permission $permission)
    {
        if ($this->hasPermission($permission->name))
            return $this->permissions()->detach($permission);
    }

    /**
     * Revoke Permission to Role
     *
     * @param String $name
     * @return boolean
     */
    public function revokePermissionByName($name)
    {
        if ($this->hasPermission($name)){
            return $this->permissions()->detach(
                Permission::whereName($name)->firstOrFail()
            );
        }
    }

    /**
     * Revoke Permissions by name
     *
     * @param Array $name
     * @return boolean
     */
    public function revokePermissionsByName($name)
    {
        foreach ($names as $name) {
            $this->revokePermissionByName($name);
        }
    }

    /**
     * Revoke All Permission from Role
     *
     * @return boolean
     */
    public function revokeAllPermissions()
    {
        return $this->permissions()->detach();
    }

}