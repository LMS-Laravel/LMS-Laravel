<?php


namespace App\Repositories;


use App\Entities\Permission;
use App\Entities\Role;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use Illuminate\Support\Collection;

class EloquentPermissionRepository implements PermissionRepositoryInterface
{

    public function getModel(): Permission
    {
        return new Permission();
    }

    public function all(): Collection
    {
        return $this->getModel()->all();
    }

    public function create(array $data): Permission
    {
        return $this->getModel()->create($data);
    }

    public function where(string $column, string $operator, string $value, array $select = ['*']) : Collection
    {
        return $this->getModel()->select($select)->where($column, $operator, $value)->get();
    }

    public function destroy(array $data)
    {
        return $this->getModel()->destroy($data);
    }
}
