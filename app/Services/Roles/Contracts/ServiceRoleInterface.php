<?php


namespace App\Services\Roles\Contracts;


use App\Entities\User;

interface ServiceRoleInterface
{

    public function assignRole(User $user, string $role) : bool;

    public function hasRole(User $user, string $role) : bool;

}
