<?php


namespace App\Usescases\Courses;


use App\Repositories\Contracts\LessonRepositoryInterface;
use App\Usescases\Courses\Contracts\ListLessonUsecaseInterface;

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

    public function handle()
    {
        return $this->lessonRepository->allAvailable();
    }
}
