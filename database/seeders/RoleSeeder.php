<?php

namespace Database\Seeders;

use App\Models\User\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                "name" => "مدیر محتوا",
                "description" => "دسترسی به بخش محتوای پنل",
                "status" => 1
            ],
            [
                "name" => "اپراتور تیکت",
                "description" => "مسئول مدیریت بخش تیکت",
                "status" => 1
            ],
            [
                "name" => "پشتیبان فروش",
                "description" => "مسئول مدیریت فروشگاه",
                "status" => 1
            ],
                        [
                "name" => "پشتیبان اطلاع رسانی",
                "description" => "مدیریت اطلاع رسانی به کاربران",
                "status" => 1
            ],
                        [
                "name" => "سوپر ادمین",
                "description" => "دسترسی کامل به پنل ادمین",
                "status" => 1
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
