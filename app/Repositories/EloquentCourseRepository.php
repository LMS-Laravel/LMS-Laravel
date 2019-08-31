<?php


namespace App\Repositories;


use App\Entities\Course;
use App\Repositories\Contracts\CourseRepositoryInterface;
use Illuminate\Support\Collection;

class EloquentCourseRepository implements CourseRepositoryInterface
{

    public function getModel()
    {
        return new Course();
    }

    public function create(array $data)
    {
        return $this->getModel()->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->getModel()->find($id)->update($data);
    }

    public function delete(int $id)
    {
        return $this->getModel()->findOrFail($id)->update(['status' => 'disabled']);
    }

    public function destroy(int $id)
    {
        return $this->getModel()->findOrFail($id)->delete();
    }

    public function findById(int $id)
    {
        return $this->getModel()->findOrFail($id);
    }

    public function all() : Collection
    {
        return $this->getModel()->with('teacher')->get();
    }

    public function allAvailable() : Collection
    {
        return $this->getModel()->all()->where('status', 'enabled');
    }
}
