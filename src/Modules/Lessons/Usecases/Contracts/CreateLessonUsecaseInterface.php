<?php


namespace LMS\Modules\Lessons\Usecases\Contracts;



interface CreateLessonUsecaseInterface
{


    public function handle(array $data, int $authUser);
}
