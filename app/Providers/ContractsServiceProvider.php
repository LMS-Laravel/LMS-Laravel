<?php


namespace App\Providers;


use App\Repositories\Contracts\{CourseRepositoryInterface, LessonRepositoryInterface, PermissionRepositoryInterface, RoleRepositoryInterface, UserRepositoryInterface};
use App\Repositories\{EloquentCourseRepository, EloquentUserRepository, EloquentLessonRepository, EloquentPermissionRepository, EloquentRoleRepository};


use Illuminate\Support\ServiceProvider;
use LMS\Modules\Courses\Usescases\Contracts\{CreateCourseUsescaseInterface, ListCourseUsecaseInterface, DeleteCourseUsecaseInterface, UpdateCourseUsecaseInterface};
use LMS\Modules\Courses\Usescases\{CreateCourseUsecase, ListCourseUsecase, UpdateCourseUsecase, DeleteCourseUsecase};
use LMS\Modules\Lessons\Usescases\Contracts\{CreateLessonUsecaseInterface, ListLessonUsecaseInterface, UpdateLessonUsescaseInterface, DeleteLessonUsescaseInterface};
use LMS\Modules\Lessons\Usescases\{CreateLessonUsecase, ListLessonUsecase, UpdateLessonUsecase, DeleteLessonUsecase};
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
