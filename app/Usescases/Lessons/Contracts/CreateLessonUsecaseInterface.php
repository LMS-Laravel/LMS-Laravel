<?php


namespace App\Usescases\Lessons\Contracts;



interface CreateLessonUsecaseInterface
{


    public function handle(array $data, int $authUser);
}
