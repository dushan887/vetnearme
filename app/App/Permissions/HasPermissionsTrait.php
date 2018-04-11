<?php

namespace App\App\Permissions;

use App\{Role, Permission};

/**
 *
 */
trait HasPermissionsTrait
{
    public function givePermission(...$permissions)
    {
        $permissions = $this->getPermissions(\array_flatten($permissions));

        if($permissions === null)
            return $this;

        $this->permissions()->saveMany($permissions);

        return $this;
    }

    public function widrawPermission(...$permissions)
    {
        $permissions = $this->getPermissions(\array_flatten($permissions));

        $this->permissions()->detach($permissions);

        return $this;
    }

    public function updatePermissions(...$permissions)
    {
        $this->permissions()->detach();

        return $this->givePermission($permissions);
    }

    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {

            if($this->roles->contains('name', $role))
                return true;

        }

        return false;
    }

    public function hasPermissionTo($permission)
    {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

    protected function hasPermission($permission)
    {
        return (bool) $this->permissions->where('name', $permission->name)->count();
    }

    protected function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role) {
            if($this->role->contains($role))
                return true;
        }

        return false;
    }

    protected function getPermissions(array $permissions)
    {
        return Permissions::whereIn('name', $permissions)->get();
    }

    public function roles()
    {
         return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function permissions()
    {
       return $this->belongsToMany(Permissions::class, 'user_permissions');
    }
}
