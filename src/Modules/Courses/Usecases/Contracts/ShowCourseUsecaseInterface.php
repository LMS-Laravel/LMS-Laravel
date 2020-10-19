<?php


namespace LMS\Modules\Courses\Usecases\Contracts;


interface ShowCourseUsecaseInterface
{


    public function handle(int $course_id, int $user_id);
}
