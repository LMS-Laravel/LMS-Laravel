<?php


namespace App\Usescases\Courses\Contracts;



interface CreateLessonUsecaseInterface
{


    public function handle(array $data, int $authUser);
}
