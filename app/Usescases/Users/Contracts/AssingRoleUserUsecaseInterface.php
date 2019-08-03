<?php


namespace App\Usescases\Users\Contracts;


interface AssingRoleUserUsecaseInterface
{
    public function handle(int $id, string $role): bool;
}
