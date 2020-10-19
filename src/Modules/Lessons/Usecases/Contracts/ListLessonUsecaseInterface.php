<?php


namespace LMS\Modules\Lessons\Usecases\Contracts;


interface ListLessonUsecaseInterface
{
    public function handle(int $course_id);
}
