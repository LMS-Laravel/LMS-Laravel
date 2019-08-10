<?php


namespace App\Services\Contracts;


use App\Entities\User;

interface ServiceRoleInterface
{

    public function assignRole(User $user, string $role) : bool;

    public function hasRole(User $user, string $role) : bool;

}
