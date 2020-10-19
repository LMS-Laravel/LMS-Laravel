<?php


namespace LMS\Modules\Courses\Usecases;


use App\Enums\CourseStatus;
use LMS\Modules\Courses\Repositories\Contracts\CourseRepositoryInterface;
use LMS\Modules\Courses\Usecases\Contracts\DeleteCourseUsecaseInterface;

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
        $course = $this->courseRepository->findById($id);
        return $course->status == CourseStatus::ENABLED ? $this->courseRepository->delete($id) : $this->courseRepository->destroy($id);
    }
}
