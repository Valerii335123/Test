<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeed extends Seeder
{

    private array $data = [
        [
            'role' => 'admin',
            'permissions' => [
                'create post',
                'update post',
                'view post',
                'delete post',

                'create comment',
                'update comment',
                'view comment',
                'delete comment',
            ]
        ],
        [
            'role' => 'post creator',
            'permissions' => [
                'create post',
                'view post',

                'create comment',
                'view comment',
            ]
        ],

        [
            'role' => 'quest',
            'permissions' => [
                'view post',

                'view comment',
            ]
        ],

    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->data as $roles) {
            $role = Role::firstOrCreate(['name' => $roles['role']]);
            foreach ($roles['permissions'] as $permissions) {
                $permission = Permission::firstOrCreate(['name' => $permissions]);
                $role->givePermissionTo($permission);
            }
        }

        User::whereEmail('test@example.com')->first()->assignRole('admin');
    }
}
