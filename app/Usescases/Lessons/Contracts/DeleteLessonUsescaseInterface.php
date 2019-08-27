<?php


namespace App\Usescases\Lessons\Contracts;


interface DeleteLessonUsescaseInterface
{
    public function handle(int $id);
}
