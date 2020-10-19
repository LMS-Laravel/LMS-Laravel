<?php


namespace App\Providers;


use App\Repositories\Contracts\{PermissionRepositoryInterface, RoleRepositoryInterface, UserRepositoryInterface};
use App\Repositories\{EloquentUserRepository, EloquentPermissionRepository, EloquentRoleRepository};


use Illuminate\Support\ServiceProvider;
use LMS\Modules\Courses\Usecases\Contracts\{CreateCourseUsescaseInterface,
    ListCourseUsecaseInterface,
    DeleteCourseUsecaseInterface,
    ShowCourseUsecaseInterface,
    SubscribeCourseUsecaseInterface,
    UpdateCourseUsecaseInterface};
use LMS\Modules\Courses\Usecases\{CreateCourseUsecase, ListCourseUsecase, UpdateCourseUsecase, DeleteCourseUsecase};
use LMS\Modules\Lessons\Usecases\Contracts\{CreateLessonUsecaseInterface,
    ListLessonUsecaseInterface,
    ShowLessonUsecaseInterface,
    UpdateLessonUsescaseInterface,
    DeleteLessonUsescaseInterface};
use LMS\Modules\Lessons\Usecases\{CreateLessonUsecase,
    ListLessonUsecase,
    ShowLessonUsecase,
    UpdateLessonUsecase,
    DeleteLessonUsecase};
use LMS\Modules\Courses\Repositories\Contracts\CourseRepositoryInterface;
use LMS\Modules\Courses\Repositories\EloquentCourseRepository;
use LMS\Modules\Courses\Usecases\ShowCourseUsecase;
use LMS\Modules\Courses\Usecases\SubscribeCourseUsecase;
use LMS\Modules\Lessons\Repositories\Contracts\LessonRepositoryInterface;
use LMS\Modules\Lessons\Repositories\EloquentLessonRepository;
use LMS\Modules\Users\Services\Roles\Contracts\ServiceRoleInterface;
use LMS\Modules\Users\Services\Roles\SpatieServiceRole;
use LMS\Modules\Users\Usescases\AssignRoleUserUsecase;
use LMS\Modules\Users\Usescases\Contracts\AssignRoleUserUsecaseInterface;


class ContractsServiceProvider extends ServiceProvider
{
    /**
     *
     * @var array
     */
    public $bindings = [
        //Repositories
        UserRepositoryInterface::class => EloquentUserRepository::class,
        CourseRepositoryInterface::class => EloquentCourseRepository::class,
        RoleRepositoryInterface::class => EloquentRoleRepository::class,
        PermissionRepositoryInterface::class => EloquentPermissionRepository::class,
        LessonRepositoryInterface::class => EloquentLessonRepository::class,

        //Usescases
        CreateCourseUsescaseInterface::class => CreateCourseUsecase::class,
        ListCourseUsecaseInterface::class => ListCourseUsecase::class,
        UpdateCourseUsecaseInterface::class => UpdateCourseUsecase::class,
        DeleteCourseUsecaseInterface::class => DeleteCourseUsecase::class,
        CreateLessonUsecaseInterface::class => CreateLessonUsecase::class,
        AssignRoleUserUsecaseInterface::class => AssignRoleUserUsecase::class,
        UpdateLessonUsescaseInterface::class => UpdateLessonUsecase::class,
        DeleteLessonUsescaseInterface::class => DeleteLessonUsecase::class,
        ListLessonUsecaseInterface::class => ListLessonUsecase::class,
        ShowLessonUsecaseInterface::class => ShowLessonUsecase::class,
        ShowCourseUsecaseInterface::class => ShowCourseUsecase::class,
        SubscribeCourseUsecaseInterface::class => SubscribeCourseUsecase::class,

        //Services
        ServiceRoleInterface::class => SpatieServiceRole::class
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
