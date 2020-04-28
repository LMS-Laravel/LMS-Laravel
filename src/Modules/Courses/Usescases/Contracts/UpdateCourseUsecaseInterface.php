<?php


namespace LMS\Modules\Courses\Usescases\Contracts;


interface UpdateCourseUsecaseInterface
{

    public function handle(int $id, array $data);

}
