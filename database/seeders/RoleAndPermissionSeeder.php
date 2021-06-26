<?php

namespace Database\Seeders;

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
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {

        $this->refreshMigration();

        $this->seedDefaultPermissions();

        $roles = $this->determineRoles();

        $this->createRoles($roles);

    }


    private function refreshMigration() {

        // Ask for db migration refresh, default is no
        if ($this->command->confirm('Do you wish to refresh migration before seeding? It will clear all old data.', true)) {

            $this->command->info('Refreshing migrations...');

            // Call the php artisan migrate:refresh
            $this->command->call('migrate:refresh');

            $this->command->warn("Data cleared, starting from blank database.");
        }

    }


    private function seedDefaultPermissions() {

        $this->command->info('Adding default permissions...');

        // Seed the default permissions
        $permissions = Permission::defaultPermissions();

        foreach ($permissions as $perms) {
            $this->permissionRepository->create(['name' => $perms]);
        }

        $this->command->info('Default permissions added.');

    }


    private function determineRoles() {

        // Confirm roles needed
        if ($this->command->confirm('Would you like to specify your own user Roles? If not, "Admin" and "User" will automatically be created. ', false)) {

            // Ask for roles from input
            $input_roles = $this->command->ask('Enter roles in comma separate format.', 'Admin,Teacher,User');

            // Explode roles
            $roles_array = explode(',', $input_roles);

            return $roles_array;

        }

        return ['Admin','User'];

    }


    private function createRoles($roles) {

        // add roles
        foreach($roles as $role_name) {

            // format the role name
            $role_name = ucfirst( trim($role_name) );

            // create the role
            if( $role = $this->createRole($role_name) ) {

                // create one user for each role
                $this->createUser($role);

            }

        }

    }


    private function createRole($role_name) {

        $this->command->info( sprintf("Creating '%s' Role...", $role_name) );

        if( $role = $this->roleRepository->create(['name' => $role_name]) ) {

            $this->command->info( sprintf("'%s' Role created.", $role->name) );

            $this->assignRolePermissions($role, ($role->name == 'Admin'));

            return $role;

        } else {

            $this->command->error( sprintf("Could not create the '%s' Role!", $role) );

        }

    }


    private function assignRolePermissions($role, $isAdmin = false) {

        $this->command->info( sprintf("Granting %s permissions to '%s'...", ($isAdmin ? 'all' : 'read-only'), $role->name) );

        $role->syncPermissions(
            $isAdmin ? $this->permissionRepository->all() : $this->permissionRepository->where('name', 'LIKE', 'view_%')
        );

        $this->command->info( "Permissions granted " );

    }


    /**
     * Create a user with given role
     *
     * @param $role
     */
    private function createUser($role)
    {

        $this->command->info( sprintf("Creating user for '%s' role...", $role->name) );

        if($user = $this->createUserWithRole($role)) {

            $this->showUserCredentials($user);

        } else {

            $this->command->error( sprintf("Could not create user for '%s' role!", $role->name) );

        }

    }


    private function createUserWithRole($role) {

        $user = User::factory()->make();

        $user->assignRole($role->name);

        $user->save();

        return $user;

    }


    private function showUserCredentials($user) {

        $this->command->info("User Credentials:");

        $this->command->warn( sprintf("Name: %s", $user->name) );

        $this->command->warn( sprintf("Email: %s", $user->email) );

        $this->command->warn( sprintf("Password: %s", 'password') );

    }

}
