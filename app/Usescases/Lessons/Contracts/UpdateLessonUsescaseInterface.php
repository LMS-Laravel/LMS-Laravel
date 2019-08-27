<?php


namespace App\Usescases\Lessons\Contracts;


interface UpdateLessonUsescaseInterface
{
    public function handle(int $id, array $data);
}
