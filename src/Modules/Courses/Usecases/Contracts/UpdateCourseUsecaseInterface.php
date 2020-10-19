<?php


namespace LMS\Modules\Courses\Usecases\Contracts;


interface UpdateCourseUsecaseInterface
{

    public function handle(int $id, array $data);

}
