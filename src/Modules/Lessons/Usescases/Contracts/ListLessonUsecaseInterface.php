<?php


namespace LMS\Modules\Lessons\Usescases\Contracts;


interface ListLessonUsecaseInterface
{
    public function handle(int $course_id);
}
