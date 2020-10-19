<?php


namespace LMS\Modules\Courses\Usecases;


use LMS\Modules\Courses\Repositories\Contracts\CourseRepositoryInterface;
use LMS\Modules\Courses\Usecases\Contracts\ListCourseUsecaseInterface;

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
