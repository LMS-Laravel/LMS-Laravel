<?php


namespace App\Repositories\Contracts;


use Illuminate\Support\Collection;

interface CourseRepositoryInterface
{
    public function getModel();

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);

    public function destroy(int $id);

    public function findById(int $id);

    public function all() : Collection;

    public function allAvailable() : Collection;
}
