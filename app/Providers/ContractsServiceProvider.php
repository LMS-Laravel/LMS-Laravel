<?php


namespace App\Providers;


use App\Repositories\Contracts\{CourseRepositoryInterface, LessonRepositoryInterface, PermissionRepositoryInterface, RoleRepositoryInterface, UserRepositoryInterface};
use App\Repositories\{EloquentCourseRepository, EloquentUserRepository, EloquentLessonRepository, EloquentPermissionRepository, EloquentRoleRepository};
use App\Services\Roles\Contracts\ServiceRoleInterface;
use App\Services\Roles\SpatieServiceRole;
use App\Usescases\Courses\Contracts\CreateCourseUsescaseInterface;
use App\Usescases\Lessons\Contracts\CreateLessonUsecaseInterface;
use App\Usescases\Lessons\Contracts\DeleteLessonUsescaseInterface;
use App\Usescases\Courses\Contracts\ListCourseUsecaseInterface;
use App\Usescases\Lessons\Contracts\ListLessonUsecaseInterface;
use App\Usescases\Courses\Contracts\UpdateCourseUsecaseInterface;
use App\Usescases\Courses\Contracts\DeleteCourseUsecaseInterface;
use App\Usescases\Lessons\Contracts\UpdateLessonUsescaseInterface;
use App\Usescases\Courses\CreateCourseUsecase;
use App\Usescases\Courses\CreateLessonUsecase;
use App\Usescases\Courses\DeleteLessonUsecase;
use App\Usescases\Courses\ListCourseUsecase;
use App\Usescases\Courses\ListLessonUsecase;
use App\Usescases\Courses\UpdateCourseUsecase;
use App\Usescases\Courses\DeleteCourseUsecase;
use App\Usescases\Courses\UpdateLessonUsecase;
use App\Usescases\Users\AssignRoleUserUsecase;
use App\Usescases\Users\Contracts\AssignRoleUserUsecaseInterface;

use Illuminate\Support\ServiceProvider;



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
