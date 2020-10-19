<?php


namespace LMS\Modules\Courses\Usecases;


use LMS\Modules\Courses\Repositories\Contracts\CourseRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use LMS\Modules\Core\Usecases\BaseUsecase;
use LMS\Modules\Courses\Usecases\Contracts\ShowCourseUsecaseInterface;
use LMS\Modules\Lessons\Usecases\ListLessonUsecase;

class ShowCourseUsecase extends BaseUsecase implements ShowCourseUsecaseInterface
{
    /**
     * @var CourseRepositoryInterface
     */
    private $courseRepository;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var ListLessonUsecase
     */
    private $listLessonUsecase;

    public function __construct(CourseRepositoryInterface $courseRepository, UserRepositoryInterface $userRepository, ListLessonUsecase $listLessonUsecase)
    {
        $this->courseRepository = $courseRepository;
        $this->userRepository = $userRepository;
        $this->listLessonUsecase = $listLessonUsecase;
    }

    public function handle(int $course_id, int $user_id)
    {
        $user = $this->userRepository->findById($user_id);
        $course = $this->courseRepository->findById($course_id);

        $lessons = $this->listLessonUsecase->handle($course_id);
        $this->response = [
            "course" => $course,
            "lessons" => $lessons,
            "subscribed" => $this->courseRepository->checkSubscribed($course_id, $user_id),
        ];

        return $this->parseResponse();

    }
}
