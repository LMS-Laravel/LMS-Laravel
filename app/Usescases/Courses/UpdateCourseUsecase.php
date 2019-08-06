<?php


namespace App\Usescases\Courses;


use App\Repositories\Contracts\CourseRepositoryInterface;
use App\Usescases\Courses\Contracts\UpdateCourseUsecaseInterface;

class UpdateCourseUsecase implements UpdateCourseUsecaseInterface
{

    /**
     * @var CourseRepositoryInterface
     */
    private $courseRepository;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function handle(int $id, array $data)
    {
        return $this->courseRepository->update($id, $data);
    }
}
