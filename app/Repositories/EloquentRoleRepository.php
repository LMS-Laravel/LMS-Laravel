<?php


namespace App\Repositories;


use App\Entities\Role;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Support\Collection;

class EloquentRoleRepository implements RoleRepositoryInterface
{

    public function getModel(): Role
    {
        return new Role();
    }

    public function all(): Collection
    {
        return $this->getModel()->all();
    }

    public function create(array $data): Role
    {
        return $this->getModel()->create($data);
    }

    public function where(string $column, string $operator, $value) : Collection
    {
        return $this->getModel()->where($column, $operator, $value)->get();
    }

    public function findById(int $id): Role
    {
        return $this->getModel()->find($id);
    }
}
