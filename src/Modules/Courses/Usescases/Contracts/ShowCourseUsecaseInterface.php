<?php


namespace LMS\Modules\Courses\Usescases\Contracts;


interface ShowCourseUsecaseInterface
{


    public function handle(int $course_id, int $user_id);
}
