<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Permission extends \Spatie\Permission\Models\Permission
{


    public static function defaultPermissions()
    {
        return [
            'view_users',
            'add_users',
            'edit_users',
            'delete_users',

            'view_roles',
            'add_roles',
            'edit_roles',
            'delete_roles',

            'view_courses',
            'add_courses',
            'edit_courses',
            'delete_courses',

            'view_lessons',
            'add_lessons',
            'edit_lessons',
            'delete_lessons',

            'view_admin',
        ];
    }
}
