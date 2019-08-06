<?php


namespace App\Usescases\Courses;


use App\Repositories\Contracts\LessonRepositoryInterface;
use App\Usescases\Courses\Contracts\CreateLessonUsecaseInterface;

class CreateLessonUsecase implements CreateLessonUsecaseInterface
{

    /**
     * @var LessonRepositoryInterface
     */
    private $lessonRepository;

    public function __construct(LessonRepositoryInterface $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    public function handle(array $data)
    {
        return $this->lessonRepository->create($data);
    }
}
