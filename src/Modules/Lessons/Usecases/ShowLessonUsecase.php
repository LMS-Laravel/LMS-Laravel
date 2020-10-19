<?php


namespace LMS\Modules\Lessons\Usecases;


use LMS\Modules\Courses\Repositories\Contracts\CourseRepositoryInterface;
use LMS\Modules\Lessons\Repositories\Contracts\LessonRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use LMS\Modules\Core\Usecases\BaseUsecase;
use LMS\Modules\Lessons\Usecases\Contracts\ShowLessonUsecaseInterface;

class ShowLessonUsecase extends BaseUsecase implements ShowLessonUsecaseInterface
{

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var LessonRepositoryInterface
     */
    private $lessonRepository;
    /**
     * @var CourseRepositoryInterface
     */
    private $courseRepository;

    public function __construct(UserRepositoryInterface $userRepository, LessonRepositoryInterface $lessonRepository, CourseRepositoryInterface $courseRepository)
    {
        $this->userRepository = $userRepository;
        $this->lessonRepository = $lessonRepository;
        $this->courseRepository = $courseRepository;
    }

    public function handle(int $lesson_id, int $user_id)
    {
        $user = $this->userRepository->findById($user_id);
        $lesson = $this->lessonRepository->findById($lesson_id);
        $this->response = [
            "lesson" => $lesson,
            "subscribed" => $this->courseRepository->checkSubscribed($lesson->course->id, $user_id),
        ];

        return $this->parseResponse();
    }
}
