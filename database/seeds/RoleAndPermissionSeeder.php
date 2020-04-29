<?php

use App\Entities\{ Permission, User};
use App\Repositories\Contracts\{ PermissionRepositoryInterface, RoleRepositoryInterface, UserRepositoryInterface};
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{

    /**
     * @var PermissionRepositoryInterface
     */
    private $permissionRepository;
    /**
     * @var RoleRepositoryInterface
     */
    private $roleRepository;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository, RoleRepositoryInterface $roleRepository, UserRepositoryInterface $userRepository)
    {
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ask for db migration refresh, default is no
        if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data ?')) {
            // Call the php artisan migrate:refresh
            $this->command->call('migrate:refresh');
            $this->command->warn("Data cleared, starting from blank database.");
        }

        // Seed the default permissions
        $permissions = Permission::defaultPermissions();

        foreach ($permissions as $perms) {
            $this->permissionRepository->create(['name' => $perms]);
        }

        $this->command->info('Default Permissions added.');

        // Confirm roles needed
        if ($this->command->confirm('Create Roles for user, default is admin and user? [y|N]', true)) {

            // Ask for roles from input
            $input_roles = $this->command->ask('Enter roles in comma separate format.', 'Admin,Teacher,User');

            // Explode roles
            $roles_array = explode(',', $input_roles);

            // add roles
            foreach($roles_array as $role) {
                $role = $this->roleRepository->create(['name' => trim($role)]);

                if( $role->name == 'Admin' ) {
                    // assign all permissions
                    $role->syncPermissions($this->permissionRepository->all());
                    $this->command->info('Admin granted all the permissions');
                } else {
                    // for others by default only read access
                    $role->syncPermissions($this->permissionRepository->where('name', 'LIKE', 'view_%'));
                }

                // create one user for each role
                $this->createUser($role);
            }

            $this->command->info('Roles ' . $input_roles . ' added successfully');

        } else {
            $this->roleRepository->create(['name' => 'User']);
            $this->command->info('Added only default user role.');
        }

    }

    /**
     * Create a user with given role
     *
     * @param $role
     */
    private function createUser($role)
    {
        $user = factory(User::class)->create();
        $user->assignRole($role->name);

        if( $role->name == 'Admin' ) {
            $this->command->info('Here is your admin details to login:');
            $this->command->warn($user->email);
            $this->command->warn($user->username);
            $this->command->warn('Password is "password"');
        }
    }
}
