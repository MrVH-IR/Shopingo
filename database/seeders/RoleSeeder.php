<?php

namespace Database\Seeders;

use App\Models\User\Permission;
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
            ["name" => "مدیر محتوا", "description" => "دسترسی به بخش محتوای پنل", "status" => 1],
            ["name" => "اپراتور تیکت", "description" => "مسئول مدیریت بخش تیکت", "status" => 1],
            ["name" => "پشتیبان فروش", "description" => "مسئول مدیریت فروشگاه", "status" => 1],
            ["name" => "پشتیبان اطلاع رسانی", "description" => "مدیریت اطلاع رسانی به کاربران", "status" => 1],
            ["name" => "سوپر ادمین", "description" => "دسترسی کامل به پنل ادمین", "status" => 1],
        ];

        $permissions = [
            ["name" => "createPosts" , "description" => "ساخت پست" , "status" => 1],
            ["name" => "editPosts" , "description" => "تغییر دادن پست" , "status" => 1],
            ["name" => "deletePosts" , "description" => "پاک کردن پست" , "status" => 1],
            ["name" => "observePosts" , "description" => "دیدن پست" , "status" => 1],
            ["name" => "createTickets" , "description" => "ساخت تیکت" , "status" => 1],
            ["name" => "deleteTickets" , "description" => "پاک کردن تیکت" , "status" => 1],
            ["name" => "editTickets" , "description" => "تغییر تیکت" , "status" => 1],
            ["name" => "observeTickets" , "description" => "دیدن تیکت" , "status" => 1],
            ["name" => "createContents" , "description" => "ساخت دسته بندی" , "status" => 1],
            ["name" => "editContents" , "description" => "تغییر دسته بندی" , "status" => 1],
            ["name" => "deleteContents" , "description" => "پاک کردن دسته بندی" , "status" => 1],
            ["name" => "observeContents" , "description" => "دیدن دسته بندی" , "status" => 1],
            ["name" => "createUsers" , "description" => "ساخت کاربر" , "status" => 1],
            ["name" => "deleteUsers" , "description" => "حذف کاربر" , "status" => 1],
            ["name" => "editUsers" , "description" => "تغییر اطلاعات کاربر" , "status" => 1],
            ["name" => "observeUsers" , "description" => "دیدن اطلاعات کاربر" , "status" => 1],
            ["name" => "createNotif" , "description" => "ساخت اطلاعیه" , "status" => 1],
            ["name" => "editNotif" , "description" => "تغییر اطلاعیه" , "status" => 1],
            ["name" => "deleteNotif" , "description" => "پاک کردن اطلاعیه" , "status" => 1],
            ["name" => "observeNotif" , "description" => "دیدن اطلاعات اطلاعیه" , "status" => 1],
            ["name" => "createDelivery" , "description" => "ساخت روش ارسال" , "status" => 1],
            ["name" => "editDelivery" , "description" => "تغییر روش ارسال" , "status" => 1],
            ["name" => "deleteDelivery" , "description" => "پاک کردن روش ارسال" , "status" => 1],
            ["name" => "observeDelivery" , "description" => "دیدن اطلاعات روش ارسال" , "status" => 1],
            ["name" => "accessSettings" , "description" => "دیدن تنظیمات سایت" , "status" => 1],
            ["name" => "editSettings" , "description" => "تغییر تنظیمات سایت" , "status" => 1],
            ["name" => "accessOrders" , "description" => "دسترسی به سفارشات" , "status" => 1],
            ["name" => "changeOrders" , "description" => "دسترسی به تغییر سفارشات" , "status" => 1],
            ["name" => "accessPayments" , "description" => "دسترسی به پرداخت ها" , "status" => 1],
            ["name" => "changePayments" , "description" => "دسترسی به تغییر پرداخت ها" , "status" => 1],
            ["name" => "createDiscounts" , "description" => "ساخت کوپن تخفیف" , "status" => 1],
            ["name" => "editDiscounts" , "description" => "تغییر اطلاعات کوپن تخفیف" , "status" => 1],
            ["name" => "deleteDiscounts" , "description" => "پاک کردن کوپن تخفیف" , "status" => 1],
            ["name" => "observeDiscounts" , "description" => "دیدن کوپن تخفیف" , "status" => 1],
            ["name" => "createMarket" , "description" => "دسترسی به فروشگاه" , "status" => 1],
            ["name" => "editMarket" , "description" => "تغییر اطلاعات فروشگاه" , "status" => 1],
            ["name" => "deleteMarket" , "description" => "پاک کردن اطلاعات فروشگاه" , "status" => 1],
            ["name" => "observeMarket" , "description" => "دیدن فروشگاه" , "status" => 1],
            ["name" => "guest" , "description" => "مهمان" , "status" => 1],
            ["name" => "superAdmin" , "description" => "مدیر" , "status" => 1],
        ];

        foreach ($roles as $r) {
            Role::updateOrCreate(
                ['name' => $r['name']],
                ['description' => $r['description'], 'status' => $r['status']]
            );
        }

        foreach ($permissions as $p) {
            Permission::updateOrCreate([
                "name" => $p['name'],
                "description" => $p['description'],
                "status" => $p['status'],
            ]);
        }
    }
}
