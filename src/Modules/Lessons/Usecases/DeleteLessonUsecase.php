<?php


namespace LMS\Modules\Lessons\Usecases;


use App\Enums\LessonStatus;
use LMS\Modules\Lessons\Repositories\Contracts\LessonRepositoryInterface;
use LMS\Modules\Lessons\Usecases\Contracts\DeleteLessonUsescaseInterface;

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
        $lesson = $this->lessonRepository->findById($id);
        return $lesson->status == LessonStatus::ENABLED ? $this->lessonRepository->delete($id) : $this->lessonRepository->destroy($id);
    }

}
