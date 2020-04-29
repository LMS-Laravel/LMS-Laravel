<?php


namespace LMS\Modules\Lessons\Usescases\Contracts;


interface UpdateLessonUsescaseInterface
{
    public function handle(int $id, array $data);
}
