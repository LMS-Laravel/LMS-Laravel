<?php


namespace App\Usescases\Courses\Contracts;


interface UpdateCourseUsecaseInterface
{

    public function handle(int $id, array $data);

}
