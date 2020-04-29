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
        $data['status'] = 'enabled';
        return $model;
    }

    public function update(int $id, array $data)
    {
        $model = $this->getModel()->find($id);
        $model->update($data);
        $model->lb_content = $data['content'] ?? $model->lb_content;
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

    public function destroy(int $id)
    {
        return $this->getModel()->findOrFail($id)->delete();
    }

    public function all() : Collection
    {
        return $this->getModel()->all();
    }

    public function allAvailable(int $course_id) : Collection
    {
        return $this->getModel()->all()->where('course_id', '=', $course_id)->where('status', 'enabled');
    }
}
