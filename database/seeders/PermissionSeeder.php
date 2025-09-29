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
            ["name" => "Content", "description" => "Full Access", "status" => 1],
            ["name" => "Ticket", "description" => "Full Access", "status" => 1],
            ["name" => "Support", "description" => "Full Access", "status" => 1],
            ["name" => "Notify", "description" => "Full Access", "status" => 1],
            ["name" => "SuperAdmin", "description" => "Full Access", "status" => 1],
        ];

        foreach ($permissions as $p) {
            Permission::updateOrCreate(
                ['name' => $p['name']],
                ['description' => $p['description'], 'status' => $p['status']]
            );
        }
    }
}
