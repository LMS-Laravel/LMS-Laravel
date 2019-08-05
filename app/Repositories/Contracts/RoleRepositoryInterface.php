<?php


namespace App\Repositories\Contracts;


use App\Entities\Role;
use Illuminate\Support\Collection;

interface RoleRepositoryInterface
{

    public function getModel() : Role;
    public function all() : Collection;
    public function create(array $data):  Role;
    public function where(string $column, string $operator, $value) : Collection;
    public function findById(int $id) : Role;
}
