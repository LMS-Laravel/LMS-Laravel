<?php


namespace LMS\Modules\Lessons\Usecases\Contracts;


interface DeleteLessonUsescaseInterface
{
    public function handle(int $id);
}
