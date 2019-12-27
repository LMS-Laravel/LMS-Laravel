<?php


namespace App\Services\Roles;


use App\Entities\User;
use App\Services\Roles\Contracts\ServiceRoleInterface;

class SpatieServiceRole implements ServiceRoleInterface
{

    public function assignRole(User $user, string $role): bool
    {
        try {
            $user->assignRole($role);
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function hasRole(User $user, string $role): bool
    {
        return $user->hasRole($role);
    }
}
