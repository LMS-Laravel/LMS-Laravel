<?php


namespace App\Repositories\Contracts;


use App\Entities\Lesson;
use Illuminate\Support\Collection;

interface LessonRepositoryInterface
{

    public function getModel() : Lesson;

    public function create(array $data) : Lesson;

    public function update(int $id, array $data);

    public function delete(int $id);

    public function destroy(int $id);

    public function all() : Collection;

    public function allAvailable() : Collection;

    public function findById(int $id);

}
