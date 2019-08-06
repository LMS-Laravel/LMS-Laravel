<?php


namespace App\Usescases\Courses;


use App\Repositories\Contracts\LessonRepositoryInterface;
use App\Usescases\Courses\Contracts\DeleteLessonUsescaseInterface;

class DeleteLessonUsecase implements DeleteLessonUsescaseInterface
{
    /**
     * @var LessonRepositoryInterface
     */
    private $lessonRepository;

    public function __construct(LessonRepositoryInterface $lessonRepository)
    {
        $this->lessonRepository = $lessonRepository;
    }

    public function handle(int $id)
    {
        $this->lessonRepository->delete($id);
    }

}
