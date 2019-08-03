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

    public function update(array $data)
    {
        return $this->getModel()->update($data);
    }

    public function findById(int $id)
    {
        return $this->getModel()->find($id);
    }

    public function all()
    {
        return $this->getModel()->all();
    }
}
