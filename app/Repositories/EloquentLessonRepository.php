<?php


namespace App\Repositories;


use App\Entities\Lesson;
use App\Repositories\Contracts\LessonRepositoryInterface;
use Illuminate\Support\Collection;

class EloquentLessonRepository  implements LessonRepositoryInterface
{

    public function getModel(): Lesson
    {
        return new Lesson();
    }

    public function create(array $data): Lesson
    {
        return $this->getModel()->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->getModel()->find($id)->update($data);
    }

    public function findById(int $id)
    {
        return $this->getModel()->findOrFail($id);
    }

    public function delete(int $id)
    {
        return $this->getModel()->findOrFail($id)->update(['status' => 'disabled']);
    }

    public function all() : Collection
    {
        return $this->getModel()->all();
    }
}
