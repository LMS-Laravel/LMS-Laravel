<?php


namespace App\Usescases\Courses;


use App\Repositories\Contracts\LessonRepositoryInterface;
use App\Usescases\Courses\Contracts\UpdateLessonUsescaseInterface;

class UpdateLessonUsecase implements UpdateLessonUsescaseInterface
{
    /**
     * @var LessonRepositoryInterface
     */
    private $lessonRepository;

    public function __construct(LessonRepositoryInterface $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    public function handle(int $id, array $data)
    {
        return $this->lessonRepository->update($id, $data);
    }
}
