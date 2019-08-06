<?php


namespace App\Repositories;


use App\Entities\Lesson;
use App\Repositories\Contracts\LessonRepositoryInterface;

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
}
