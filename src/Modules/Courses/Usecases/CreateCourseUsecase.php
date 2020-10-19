<?php


namespace LMS\Modules\Courses\Usecases;


use App\Entities\User;
use App\Enums\Roles;
use App\Repositories\Contracts\{UserRepositoryInterface};
use LMS\Modules\Core\Usecases\BaseUsecase;
use LMS\Modules\Courses\Repositories\Contracts\CourseRepositoryInterface;
use LMS\Modules\Courses\Usecases\Contracts\CreateCourseUsescaseInterface;
use LMS\Modules\Users\Services\Roles\Contracts\ServiceRoleInterface;

class CreateCourseUsecase extends BaseUsecase implements CreateCourseUsescaseInterface
{

    /**
     * @var CourseRepositoryInterface
     */
    private $courseRepository;
    /**
     * @var ServiceRoleInterface
     */
    private $serviceRole;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(CourseRepositoryInterface $courseRepository, ServiceRoleInterface $serviceRole, UserRepositoryInterface $userRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->serviceRole = $serviceRole;
        $this->userRepository = $userRepository;
    }

    public function handle(array $data)
    {
        $teacher = $this->userRepository->findById($data['teacher_id']);

        $this->isTeacher($teacher);

        $this->response = $this->status ? $this->courseRepository->create($data) : false;

        return $this->parseResponse();
    }

    /**
     * @param User $teacher
     */
    public function isTeacher(User $teacher): void
    {
        if (!$this->serviceRole->hasRole($teacher, Roles::TEACHER)) {
            $this->errors[] = 'not-teacher';
            $this->status = false;
        }
    }
}
