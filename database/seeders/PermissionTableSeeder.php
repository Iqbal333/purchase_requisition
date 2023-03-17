<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'post-list',
            'post-create',
            'post-edit',
            'post-delete',
            'division-list',
            'division-create',
            'division-edit',
            'division-show',
            'division-delete',
            'employee-list',
            'employee-create',
            'employee-edit',
            'employee-delete',
            'employee-show',
            'request_items-list',
            'request_items-create',
            'request_items-edit',
            'request_items-show',
            'request_items-delete',
            'list_request',
            'list_request-show',
            'list_approve',
            'list_reject',
            'approve_request',
            'reject_request'
        ];

        foreach ($data as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
