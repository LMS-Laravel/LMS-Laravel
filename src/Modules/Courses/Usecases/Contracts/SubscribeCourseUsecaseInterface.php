<?php


namespace LMS\Modules\Courses\Usecases\Contracts;


interface SubscribeCourseUsecaseInterface
{
    public function handle(int $user_id, int $course_id);
}
