<?php


namespace LMS\Modules\Lessons\Usecases;


use LMS\Modules\Lessons\Repositories\Contracts\LessonRepositoryInterface;
use LMS\Modules\Lessons\Usecases\Contracts\ListLessonUsecaseInterface;

class ListLessonUsecase implements ListLessonUsecaseInterface
{
    /**
     * @var LessonRepositoryInterface
     */
    private $lessonRepository;

    public function __construct(LessonRepositoryInterface $lessonRepository)
    {

        $this->lessonRepository = $lessonRepository;
    }

    public function handle(int $course_id)
    {
        return $this->lessonRepository->allAvailable($course_id);
    }
}
