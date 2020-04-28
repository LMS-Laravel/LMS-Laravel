<?php


namespace LMS\Modules\Courses\Usescases;


use App\Repositories\Contracts\CourseRepositoryInterface;
use LMS\Modules\Courses\Usescases\Contracts\UpdateCourseUsecaseInterface;

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
