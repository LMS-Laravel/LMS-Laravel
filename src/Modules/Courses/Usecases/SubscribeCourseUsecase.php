<?php


namespace LMS\Modules\Courses\Usecases;


use LMS\Modules\Courses\Repositories\Contracts\CourseRepositoryInterface;
use LMS\Modules\Core\Usecases\BaseUsecase;
use LMS\Modules\Courses\Usecases\Contracts\SubscribeCourseUsecaseInterface;

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
