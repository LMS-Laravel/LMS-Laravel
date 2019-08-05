<?php


namespace App\Usescases\Contracts;


interface AssignRoleUserUsecaseInterface
{
    public function handle(int $id, string $role): bool;
}
