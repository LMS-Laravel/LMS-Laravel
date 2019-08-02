<?php


namespace App\Providers;


use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\EloquentUserRepository;
use App\Services\Contracts\ServiceRoleInterface;
use App\Services\Roles\SpatieServiceRole;
use App\Usescases\Users\AssignRoleUserUsecase;
use Illuminate\Support\ServiceProvider;
use App\Usescases\Contracts\AssingRoleUserUsecaseInterface;


class ContractsServiceProvider extends ServiceProvider
{

    protected $classes = [
        //Repositories
        UserRepositoryInterface::class => EloquentUserRepository::class,

        //Usescases
        AssingRoleUserUsecaseInterface::class => AssignRoleUserUsecase::class,

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
