<?php


namespace App\Repositories\Contracts;


use App\Entities\Lesson;

interface LessonRepositoryInterface
{

    public function getModel() : Lesson;

    public function create(array $data) : Lesson;


}
