<?php


namespace App\Usescases\Courses;


use App\Entities\User;
use App\Repositories\Contracts\CourseRepositoryInterface;
use App\Repositories\Contracts\LessonRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Usescases\BaseUsecase;
use App\Usescases\Lessons\Contracts\CreateLessonUsecaseInterface;

class CreateLessonUsecase extends BaseUsecase implements CreateLessonUsecaseInterface
{

    /**
     * @var LessonRepositoryInterface
     */
    private $lessonRepository;

    /**
     * @var CourseRepositoryInterface
     */
    private $courseRepository;

    /**
     * CreateLessonUsecase constructor.
     * @param LessonRepositoryInterface $lessonRepository
     * @param CourseRepositoryInterface $courseRepository
     */
    public function __construct(LessonRepositoryInterface $lessonRepository, CourseRepositoryInterface $courseRepository)
    {
        $this->lessonRepository = $lessonRepository;
        $this->courseRepository = $courseRepository;
    }

    public function handle(array $data,  int $authUser)
    {
        $course = $this->courseRepository->findById($data['course_id']);
        $this->isHavePermissionForCreate($authUser, $course);
        $this->response =  $this->status ? $this->lessonRepository->create($data) :  false;

        return $this->parseResponse();
    }

    /**
     * @param int $authUser
     * @param $course
     */
    public function isHavePermissionForCreate(int $authUser, $course): void
    {
        if ($course->teacher_id != $authUser) {
            $this->errors[] = 'not-permission';
            $this->status = false;
        }
    }

    /**
     * @param $course
     */
    public function isCourseAvailable($course): void
    {
        if ($course->status != 'enabled') {
            $this->errors[] = 'not-available';
            $this->status = false;
        }
    }
}
