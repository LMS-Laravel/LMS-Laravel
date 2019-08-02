<?php


namespace App\Usescases\Contracts;


interface AssingRoleUserUsecaseInterface
{
    public function handle(int $id, string $role): bool;
}
