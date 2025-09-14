<?php

namespace Database\Seeders;

use App\Models\User\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                "name" => "Content Manager",
                "description" => "Full Access",
                "status" => 1
            ],
            [
                "name" => "Ticket Operator",
                "description" => "Full Access",
                "status" => 1
            ],
            [
                "name" => "Support Sales",
                "description" => "Full Access",
                "status" => 1
            ],
                        [
                "name" => "Notify Support",
                "description" => "Full Access",
                "status" => 1
            ],
                        [
                "name" => "Super Admin",
                "description" => "Full Access",
                "status" => 1
            ],
        ];

        foreach($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
