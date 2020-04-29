<?php


namespace LMS\Modules\Lessons\Usescases;


use App\Repositories\Contracts\LessonRepositoryInterface;
use LMS\Modules\Lessons\Usescases\Contracts\UpdateLessonUsescaseInterface;

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
