<?php


namespace App\Usescases\Courses;


use App\Repositories\Contracts\CourseRepositoryInterface;
use App\Usescases\Courses\Contracts\DeleteCourseUsecaseInterface;

class DeleteCourseUsecase implements DeleteCourseUsecaseInterface
{

    /**
     * @var CourseRepositoryInterface
     */
    private $courseRepository;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function handle(int $id)
    {
        return $this->courseRepository->delete($id);
    }
}
