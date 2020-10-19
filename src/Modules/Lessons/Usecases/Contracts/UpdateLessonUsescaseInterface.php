<?php


namespace LMS\Modules\Lessons\Usecases\Contracts;


interface UpdateLessonUsescaseInterface
{
    public function handle(int $id, array $data);
}
