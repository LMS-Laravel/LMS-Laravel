<?php


namespace App\Usescases\Courses;


use App\Repositories\Contracts\CourseRepositoryInterface;
use App\Usescases\Courses\Contracts\ListCourseUsecaseInterface;

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
