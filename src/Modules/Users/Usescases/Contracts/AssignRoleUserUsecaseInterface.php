<?php


namespace LMS\Modules\Users\Usescases\Contracts;


interface AssignRoleUserUsecaseInterface
{
    public function handle(int $id, string $role): bool;
}
