<?php


namespace App\Usescases\Courses;


use App\Repositories\Contracts\CourseRepositoryInterface;
use App\Usescases\Courses\Contracts\CreateCourseUsescaseInterface;

class CreateCourseUsecase implements CreateCourseUsescaseInterface
{

    /**
     * @var CourseRepositoryInterface
     */
    private $courseRepository;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function handle(array $data)
    {
        return $this->courseRepository->create($data);
    }
}
