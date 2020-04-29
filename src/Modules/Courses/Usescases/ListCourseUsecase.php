<?php


namespace LMS\Modules\Courses\Usescases;


use App\Repositories\Contracts\CourseRepositoryInterface;
use LMS\Modules\Courses\Usescases\Contracts\ListCourseUsecaseInterface;

class ListCourseUsecase implements ListCourseUsecaseInterface
{

    /**
     * @var CourseRepositoryInterface
     */
    private $courseRepository;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {

        $this->courseRepository = $courseRepository;
    }

    public function handle()
    {
        return $this->courseRepository->all();
    }
}
