<?php

namespace App\Console\Commands;

use App\Repositories\Contracts\PermissionRepositoryInterface;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakePermissionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:permission {name} {--R|remove}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for generate permission';
    /**
     * @var PermissionRepositoryInterface
     */
    private $permissionRepository;
    /**
     * @var RoleRepositoryInterface
     */
    private $roleRepository;

    /**
     * Create a new command instance.
     *
     * @param PermissionRepositoryInterface $permissionRepository
     * @param RoleRepositoryInterface $roleRepository
     */
    public function __construct(PermissionRepositoryInterface $permissionRepository, RoleRepositoryInterface $roleRepository)
    {
        parent::__construct();
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $permissions = $this->generatePermissions();

        if($is_remove = $this->option('remove')){
            $permissionsFound = $this->searchPermissions();
            $this->permissionRepository->destroy($permissionsFound);
            $this->warn('Permissions ' . implode(', ', $permissions) . ' deleted.');
        } else {
            foreach ($permissions as $permission) {
                $this->permissionRepository->create(['name' => $permission ]);
            }

            $this->info('Permissions ' . implode(', ', $permissions) . ' created.');
        }
        // sync role for admin
        if( $role = $this->roleRepository->where('name', '=', 'Admin')->first() ) {
            $role->syncPermissions($this->permissionRepository->all());
            $this->info('Admin permissions');
        }
    }

    private function generatePermissions() : array
    {
        $abilities = ['view', 'add', 'edit', 'delete'];
        $name = $this->getNameArgument();

        return array_map(function($val) use ($name) {
            return $val . '_'. $name;
        }, $abilities);
    }

    private function getNameArgument() : string
    {
        return strtolower(Str::plural($this->argument('name')));
    }

    private function searchPermissions() : array
    {
        return $this->permissionRepository->where('name', 'LIKE', '%'. $this->getNameArgument(), ['id'])->toArray();
    }
}
