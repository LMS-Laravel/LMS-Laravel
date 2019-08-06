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
        $model = $this->getModel()->create($data);
        $model->lb_content = $data['content'];
        return $model;
    }

    public function update(int $id, array $data)
    {
        $model = $this->getModel()->find($id);
        $model->update($data);
        $model->lb_content = $data['content'];
        return $model;
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
  
    public function allAvailable() : Collection
    {
        return $this->getModel()->all()->where('status', 'enabled');
    }
}
