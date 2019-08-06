<?php


namespace App\Usescases\Users\Contracts;


interface AssignRoleUserUsecaseInterface
{
    public function handle(int $id, string $role): bool;
}
