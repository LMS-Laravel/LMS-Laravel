<?php


namespace LMS\Modules\Lessons\Usescases\Contracts;



interface CreateLessonUsecaseInterface
{


    public function handle(array $data, int $authUser);
}
