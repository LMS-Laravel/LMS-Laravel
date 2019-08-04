<?php


namespace App\Repositories\Contracts;


use App\Entities\Permission;
use Illuminate\Support\Collection;

interface PermissionRepositoryInterface
{

    public function getModel() : Permission;
    public function all() : Collection;
    public function create(array $data):  Permission;
    public function where(string $column, string $operator, string $value, array $select = ['*']) : Collection;
    public function destroy(array $data);
}
