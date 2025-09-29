<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\User\Role;
use App\Models\User\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionRoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $roles = Role::all()->keyBy('name');
            $permissions = Permission::all()->keyBy('name');

            $roleToPermissions = [
                'مدیر محتوا' => ['Content'],
                'اپراتور تیکت' => ['Ticket', 'Support'],
                'پشتیبان فروش' => ['Support'],
                'پشتیبان اطلاع رسانی' => ['Notify'],
                'سوپر ادمین' => ['SuperAdmin', 'Content', 'Ticket', 'Support', 'Notify'],
            ];

            foreach ($roleToPermissions as $roleName => $permNames) {
                if (!isset($roles[$roleName])) {
                    continue;
                }

                $permIds = [];
                foreach ($permNames as $pname) {
                    if (isset($permissions[$pname])) {
                        $permIds[] = $permissions[$pname]->id;
                    }
                }
                $roles[$roleName]->permissions()->sync($permIds);
            }
            $adminAssignments = [
                1 => 'سوپر ادمین',
                2 => 'مدیر محتوا',
                3 => 'اپراتور تیکت',
                4 => 'پشتیبان فروش',
            ];

            foreach ($adminAssignments as $userId => $roleName) {
                $user = User::find($userId);
                if (!$user) continue;
                if (!isset($roles[$roleName])) continue;
                $user->roles()->sync([$roles[$roleName]->id]);
            }
        });
    }
}
