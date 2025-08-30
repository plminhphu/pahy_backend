<?php

namespace App\Traits;

trait HasPermission
{
    /**
     * Check user có role chứa permission cụ thể không
     *
     * @param string $permissionName  // tên permission (vd: appointment, customer...)
     * @param string $action          // hành động: gets|get|create|update|delete
     * @return bool
     */
    public function canDo(string $permissionName, string $action): bool
    {
        foreach ($this->roles as $role) {
            foreach ($role->permissions as $permission) {
                if ($permission->name === $permissionName) {
                    return (bool) $permission->{$action};
                }
            }
        }
        return false;
    }

    /**
     * Lấy toàn bộ permission của user
     *
     * @return \Illuminate\Support\Collection
     */
    public function allPermissions()
    {
        return $this->roles->load('permissions')
            ->pluck('permissions')
            ->flatten()
            ->unique('id');
    }
}
