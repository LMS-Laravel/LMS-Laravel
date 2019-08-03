<?php


namespace App\Providers;


use App\Repositories\Contracts\CourseRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\EloquentCourseRepository;
use App\Repositories\EloquentUserRepository;
use App\Services\Contracts\ServiceRoleInterface;
use App\Services\Roles\SpatieServiceRole;
use App\Usescases\Courses\Contracts\CreateCourseUsescaseInterface;
use App\Usescases\Courses\Contracts\ListCourseUsecaseInterface;
use App\Usescases\Courses\CreateCourseUsecase;
use App\Usescases\Courses\ListCourseUsecase;
use App\Usescases\Users\AssignRoleUserUsecase;
use App\Usescases\Users\Contracts\AssingRoleUserUsecaseInterface;
use Illuminate\Support\ServiceProvider;


class ContractsServiceProvider extends ServiceProvider
{

    protected $classes = [
        //Repositories
        UserRepositoryInterface::class => EloquentUserRepository::class,
        CourseRepositoryInterface::class => EloquentCourseRepository::class,

        //Usescases
        AssingRoleUserUsecaseInterface::class => AssignRoleUserUsecase::class,
        CreateCourseUsescaseInterface::class => CreateCourseUsecase::class,
        ListCourseUsecaseInterface::class => ListCourseUsecase::class,

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
        foreach ($this->classes as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
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
