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
            [
                'name' => 'سوپر ادمین',
                'description' => 'دسترسی کامل به تمام بخش‌های سیستم',
                'status' => 1,
            ],
            [
                'name' => 'مدیر فروشگاه',
                'description' => 'مدیریت محصولات، سفارش‌ها، پرداخت‌ها و فروشگاه',
                'status' => 1,
            ],
            [
                'name' => 'مدیر محتوا',
                'description' => 'مدیریت محتوای سایت',
                'status' => 1,
            ],
            [
                'name' => 'مدیر کاربران',
                'description' => 'مدیریت کاربران، نقش‌ها و سطح دسترسی',
                'status' => 1,
            ],
            [
                'name' => 'اپراتور پشتیبانی',
                'description' => 'مدیریت تیکت‌ها و نظرات کاربران',
                'status' => 1,
            ],
            [
                'name' => 'اپراتور اطلاع‌رسانی',
                'description' => 'مدیریت ایمیل و پیامک',
                'status' => 1,
            ],
            [
                'name' => 'مدیر تنظیمات',
                'description' => 'مدیریت تنظیمات سیستم',
                'status' => 1,
            ],
        ];

        $rolePermissions = [

            'سوپر ادمین' => [
                '*',
            ],

            'مدیر فروشگاه' => [
                'categories.*',
                'brands.*',
                'products.*',
                'comment.*',
                'delivery.*',
                'colors.*',
                'gallery.*',
                'guarantees.*',
                'properties.*',
                'property-values.*',
                'store.*',
                'orders.*',
                'payments.*',
                'discounts.*',
            ],

            'مدیر محتوا' => [
                'posts.*',
                'pages.*',
                'banners.*',
                'menus.*',
                'faq.*',
            ],

            'مدیر کاربران' => [
                'users.*',
                'admin-user.*',
                'roles.*',
                'permissions.*',
            ],

            'اپراتور پشتیبانی' => [
                'tickets.*',
                'comment.*',
            ],

            'اپراتور اطلاع‌رسانی' => [
                'notifications.*',
            ],

            'مدیر تنظیمات' => [
                'settings.*',
            ],

        ];

        $permissions = [

            // ===========================
            // Market - Category
            // ===========================
            ["name" => "categories.view", "description" => "مشاهده دسته‌بندی محصولات", "status" => 1],
            ["name" => "categories.create", "description" => "ایجاد دسته‌بندی محصولات", "status" => 1],
            ["name" => "categories.edit", "description" => "ویرایش دسته‌بندی محصولات", "status" => 1],
            ["name" => "categories.destroy", "description" => "حذف دسته‌بندی محصولات", "status" => 1],

            // Brand
            ["name" => "brands.view", "description" => "مشاهده برندها", "status" => 1],
            ["name" => "brands.create", "description" => "ایجاد برند", "status" => 1],
            ["name" => "brands.edit", "description" => "ویرایش برند", "status" => 1],
            ["name" => "brands.destroy", "description" => "حذف برند", "status" => 1],
            ["name" => "brands.status", "description" => "تغییر وضعیت برند", "status" => 1],

            // Product
            ["name" => "products.view", "description" => "مشاهده محصولات", "status" => 1],
            ["name" => "products.create", "description" => "ایجاد محصول", "status" => 1],
            ["name" => "products.edit", "description" => "ویرایش محصول", "status" => 1],
            ["name" => "products.destroy", "description" => "حذف محصول", "status" => 1],
            ["name" => "products.status", "description" => "تغییر وضعیت محصول", "status" => 1],

            ["name" => 'comment.show', "description" => 'دیدن کامنت های کاربران', "status" => 1],
            ["name" => 'comment.destroy', "description" => 'پاک کردن کامنت های کاربران', "status" => 1],
            ["name" => 'comment.status', "description" => 'تغییر وضعیت کامنت های کاربران', "status" => 1],
            ["name" => 'comment.approved', "description" => 'قبول کردن کامنت های کاربران', "status" => 1],
            ["name" => 'comment.answer', "description" => 'جواب دادن کامنت های کاربران', "status" => 1],

            ["name" => 'delivery.view', 'description' => 'دیدن روش های ارسال', 'status' => 1],
            ["name" => 'delivery.create', 'description' => 'ساخت روش های ارسال', 'status' => 1],
            ["name" => 'delivery.store', 'description' => 'ذخیره روش های ارسال', 'status' => 1],
            ["name" => 'delivery.edit', 'description' => 'تغییر روش های ارسال', 'status' => 1],
            ["name" => 'delivery.destroy', 'description' => 'پاک کردن روش های ارسال', 'status' => 1],

            // Product Colors
            ["name" => "colors.view", "description" => "مشاهده رنگ‌های محصول", "status" => 1],
            ["name" => "colors.create", "description" => "افزودن رنگ محصول", "status" => 1],
            ["name" => "colors.destroy", "description" => "حذف رنگ محصول", "status" => 1],

            // Gallery
            ["name" => "gallery.view", "description" => "مشاهده گالری محصولات", "status" => 1],
            ["name" => "gallery.create", "description" => "افزودن تصویر محصول", "status" => 1],
            ["name" => "gallery.destroy", "description" => "حذف تصویر محصول", "status" => 1],
            ["name" => "gallery.change-size", "description" => "تغییر سایز تصویر", "status" => 1],

            // Guarantees
            ["name" => "guarantees.view", "description" => "مشاهده گارانتی‌ها", "status" => 1],
            ["name" => "guarantees.create", "description" => "ایجاد گارانتی", "status" => 1],
            ["name" => "guarantees.destroy", "description" => "حذف گارانتی", "status" => 1],

            // Property
            ["name" => "properties.view", "description" => "مشاهده ویژگی‌ها", "status" => 1],
            ["name" => "properties.create", "description" => "ایجاد ویژگی", "status" => 1],
            ["name" => "properties.edit", "description" => "ویرایش ویژگی", "status" => 1],
            ["name" => "properties.destroy", "description" => "حذف ویژگی", "status" => 1],

            // Property Values
            ["name" => "property-values.view", "description" => "مشاهده مقادیر ویژگی", "status" => 1],
            ["name" => "property-values.create", "description" => "ایجاد مقدار ویژگی", "status" => 1],
            ["name" => "property-values.edit", "description" => "ویرایش مقدار ویژگی", "status" => 1],
            ["name" => "property-values.destroy", "description" => "حذف مقدار ویژگی", "status" => 1],

            // Store
            ["name" => "store.view", "description" => "مشاهده انبار", "status" => 1],
            ["name" => "store.create", "description" => "افزودن موجودی", "status" => 1],
            ["name" => "store.edit", "description" => "ویرایش موجودی", "status" => 1],

            // Orders
            ["name" => "orders.view", "description" => "مشاهده سفارش‌ها", "status" => 1],
            ["name" => "orders.show", "description" => "مشاهده جزئیات سفارش", "status" => 1],
            ["name" => "orders.change-status", "description" => "تغییر وضعیت سفارش", "status" => 1],
            ["name" => "orders.cancel", "description" => "لغو سفارش", "status" => 1],

            // Payments
            ["name" => "payments.view", "description" => "مشاهده پرداخت‌ها", "status" => 1],
            ["name" => "payments.confirm", "description" => "تأیید پرداخت", "status" => 1],
            ["name" => "payments.cancel", "description" => "لغو پرداخت", "status" => 1],
            ["name" => "payments.return", "description" => "مرجوع کردن پرداخت", "status" => 1],

            // Discounts
            ["name" => "discounts.view", "description" => "مشاهده تخفیف‌ها", "status" => 1],
            ["name" => "discounts.create", "description" => "ایجاد تخفیف", "status" => 1],
            ["name" => "discounts.edit", "description" => "ویرایش تخفیف", "status" => 1],
            ["name" => "discounts.destroy", "description" => "حذف تخفیف", "status" => 1],

            // Posts
            ["name" => "posts.view", "description" => "مشاهده پست‌ها", "status" => 1],
            ["name" => "posts.create", "description" => "ایجاد پست", "status" => 1],
            ["name" => "posts.edit", "description" => "ویرایش پست", "status" => 1],
            ["name" => "posts.destroy", "description" => "حذف پست", "status" => 1],

            // Pages
            ["name" => "pages.view", "description" => "مشاهده برگه‌ها", "status" => 1],
            ["name" => "pages.create", "description" => "ایجاد برگه", "status" => 1],
            ["name" => "pages.edit", "description" => "ویرایش برگه", "status" => 1],
            ["name" => "pages.destroy", "description" => "حذف برگه", "status" => 1],

            // Banners
            ["name" => "banners.view", "description" => "مشاهده بنرها", "status" => 1],
            ["name" => "banners.create", "description" => "ایجاد بنر", "status" => 1],
            ["name" => "banners.edit", "description" => "ویرایش بنر", "status" => 1],
            ["name" => "banners.destroy", "description" => "حذف بنر", "status" => 1],

            // Menus
            ["name" => "menus.view", "description" => "مشاهده منوها", "status" => 1],
            ["name" => "menus.create", "description" => "ایجاد منو", "status" => 1],
            ["name" => "menus.edit", "description" => "ویرایش منو", "status" => 1],
            ["name" => "menus.destroy", "description" => "حذف منو", "status" => 1],

            // FAQ
            ["name" => "faq.view", "description" => "مشاهده سوالات متداول", "status" => 1],
            ["name" => "faq.create", "description" => "ایجاد سوال متداول", "status" => 1],
            ["name" => "faq.edit", "description" => "ویرایش سوال متداول", "status" => 1],
            ["name" => "faq.destroy", "description" => "حذف سوال متداول", "status" => 1],

            // Users
            ["name" => "users.view", "description" => "مشاهده کاربران", "status" => 1],
            ["name" => "users.create", "description" => "ایجاد کاربر", "status" => 1],
            ["name" => "users.edit", "description" => "ویرایش کاربر", "status" => 1],
            ["name" => "users.destroy", "description" => "حذف کاربر", "status" => 1],

            ["name" => "admin-user.view", "description" => "دیدن صفحه ی ساخت ادمین", "status" => 1],
            ["name" => "admin-user.create", "description" => "دیدن صفحه ی ساخت ادمین", "status" => 1],
            ["name" => "admin-user.store", "description" => "ذحیره ساخت ادمین", "status" => 1],
            ["name" => "admin-user.edit", "description" => "تغییر ساخت ادمین", "status" => 1],
            ["name" => "admin-user.destroy", "description" => "پاک کردن ساخت ادمین", "status" => 1],
            ["name" => "admin-user.activation", "description" => "فعال سازی ساخت ادمین", "status" => 1],
            ["name" => "admin-user.status", "description" => "تغییر وضعیت ساخت ادمین", "status" => 1],

            // Roles
            ["name" => "roles.view", "description" => "مشاهده نقش‌ها", "status" => 1],
            ["name" => "roles.create", "description" => "ایجاد نقش", "status" => 1],
            ["name" => "roles.edit", "description" => "ویرایش نقش", "status" => 1],
            ["name" => "roles.destroy", "description" => "حذف نقش", "status" => 1],

            // Permissions
            ["name" => "permissions.view", "description" => "مشاهده دسترسی‌ها", "status" => 1],
            ["name" => "permissions.edit", "description" => "مدیریت دسترسی کاربران", "status" => 1],

            // Tickets
            ["name" => "tickets.view", "description" => "مشاهده تیکت‌ها", "status" => 1],
            ["name" => "tickets.create", "description" => "ایجاد تیکت", "status" => 1],
            ["name" => "tickets.answer", "description" => "پاسخ به تیکت", "status" => 1],
            ["name" => "tickets.change", "description" => "تغییر وضعیت تیکت", "status" => 1],

            // Settings
            ["name" => "settings.view", "description" => "مشاهده تنظیمات", "status" => 1],
            ["name" => "settings.edit", "description" => "ویرایش تنظیمات", "status" => 1],

            // Notifications
            ["name" => "notifications.view", "description" => "مشاهده اعلان‌ها", "status" => 1],
            ["name" => "notifications.create", "description" => "ایجاد اعلان", "status" => 1],
        ];
        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['name' => $role['name']],
                [
                    'description' => $role['description'],
                    'status' => $role['status'],
                ]
            );
        }
        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission['name']],
                [
                    'description' => $permission['description'],
                    'status' => $permission['status'],
                ]
            );
        }

        foreach ($rolePermissions as $roleName => $patterns) {
            $role = Role::where('name', $roleName)->first();
            if (!$role) {
                continue;
            }
            // SupreAdmin
            if (in_array('*', $patterns, true)) {
                $role->permissions()->sync(
                    Permission::pluck('id')->toArray()
                );
                continue;
            }
            $permissionIds = [];
            foreach ($patterns as $pattern) {
                if (str_ends_with($pattern, '.*')) {
                    $prefix = str_replace('.*', '', $pattern);
                    $permissionIds = array_merge(
                        $permissionIds,
                        Permission::where('name', 'like', "{$prefix}.%")
                            ->pluck('id')
                            ->toArray()
                    );
                    continue;
                }

                $permission = Permission::where('name', $pattern)->first();
                if ($permission) {
                    $permissionIds[] = $permission->id;
                }
            }
            $role->permissions()->sync(array_unique($permissionIds));
        }
    }
}
