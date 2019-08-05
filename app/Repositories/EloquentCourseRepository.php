<?php


namespace App\Repositories;


use App\Entities\Course;
use App\Repositories\Contracts\CourseRepositoryInterface;

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
        return $this->getModel()->find($id)->delete();
    }

    public function findById(int $id)
    {
        return $this->getModel()->findOrFail($id);
    }

    public function all()
    {
        return $this->getModel()->with('teacher')->get();
    }
}
