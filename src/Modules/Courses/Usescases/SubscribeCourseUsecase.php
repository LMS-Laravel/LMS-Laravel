<?php


namespace LMS\Modules\Courses\Usecases;


use App\Repositories\Contracts\CourseRepositoryInterface;
use LMS\Modules\Core\Usescases\BaseUsecase;
use LMS\Modules\Courses\Usescases\Contracts\SubscribeCourseUsecaseInterface;

class SubscribeCourseUsecase extends BaseUsecase implements SubscribeCourseUsecaseInterface
{

    /**
     * @var CourseRepositoryInterface
     */
    private $courseRepository;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function handle(int $user_id, int $course_id)
    {
        $this->response = $this->courseRepository->subscribe($course_id, $user_id);

        return $this->parseResponse();
    }
}
