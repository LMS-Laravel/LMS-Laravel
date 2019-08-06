<?php


namespace App\Usescases\Courses\Contracts;


interface UpdateLessonUsescaseInterface
{
    public function handle(int $id, array $data);
}
