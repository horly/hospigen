<?php

namespace App\Services;

use App\Models\Permission;

class PermissionService
{
    /**
     * Vérifie si un utilisateur a une permission spécifique
     *
     * @param int $userId
     * @return bool
     */
    public static function userHasPermission(int $userId): bool
    {
        $permission = Permission::where('id_user', $userId)->first();

        if($permission)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
