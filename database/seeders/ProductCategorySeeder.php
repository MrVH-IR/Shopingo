<?php

namespace Database\Seeders;

use App\Models\Market\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $image = [
                'indexArray' => [
                    'large' => 'images/product_categories/2026/09/24/1790277355/1790277355_large.jpg',
                    'medium' => 'images/product_categories/2026/09/24/1790277355/1790277355_medium.jpg',
                    'small' => 'images/product_categories/2026/09/24/1790277355/1790277355_small.jpg',
                ],
                'directory' => 'images/product_categories/2026/09/24/1790277355',
                'currentImage' => 'medium',
            ];

            $categories = [
                [
                    'name' => 'موبایل',
                    'description' => 'انواع گوشی موبایل، تلفن همراه و تجهیزات مرتبط',
                    'tags' => 'موبایل,گوشی,تلفن همراه,smartphone,mobile',
                    'show_in_menu' => true,
                    'children' => [

                        // ==================== APPLE ====================
                        [
                            'name' => 'Apple',
                            'description' => 'محصولات و گوشی‌های شرکت اپل',
                            'tags' => 'اپل,apple,iphone',
                            'children' => [
                                [
                                    'name' => 'iPhone',
                                    'description' => 'گوشی‌های آیفون',
                                    'tags' => 'آیفون,iphone,apple',
                                    'children' => [
                                        [
                                            'name' => 'سری iPhone 16',
                                            'description' => 'انواع مدل‌های آیفون ۱۶',
                                            'tags' => 'آیفون ۱۶,iphone 16',
                                        ],
                                        [
                                            'name' => 'سری iPhone 15',
                                            'description' => 'انواع مدل‌های آیفون ۱۵',
                                            'tags' => 'آیفون ۱۵,iphone 15',
                                        ],
                                        [
                                            'name' => 'سری iPhone 14',
                                            'description' => 'انواع مدل‌های آیفون ۱۴',
                                            'tags' => 'آیفون ۱۴,iphone 14',
                                        ],
                                        [
                                            'name' => 'سری iPhone 13',
                                            'description' => 'انواع مدل‌های آیفون ۱۳',
                                            'tags' => 'آیفون ۱۳,iphone 13',
                                        ],
                                    ],
                                ],
                                [
                                    'name' => 'iPhone 16',
                                    'description' => 'مدل‌های مختلف آیفون ۱۶',
                                    'tags' => 'iphone 16,آیفون ۱۶',
                                    'children' => [
                                        [
                                            'name' => 'iPhone 16 Pro',
                                            'description' => 'آیفون ۱۶ پرو',
                                            'tags' => 'iphone 16 pro,آیفون ۱۶ پرو',
                                        ],
                                        [
                                            'name' => 'iPhone 16 Pro Max',
                                            'description' => 'آیفون ۱۶ پرو مکس',
                                            'tags' => 'iphone 16 pro max,آیفون ۱۶ پرو مکس',
                                        ],
                                        [
                                            'name' => 'iPhone 16 Plus',
                                            'description' => 'آیفون ۱۶ پلاس',
                                            'tags' => 'iphone 16 plus,آیفون ۱۶ پلاس',
                                        ],
                                        [
                                            'name' => 'iPhone 16e',
                                            'description' => 'آیفون ۱۶ ای',
                                            'tags' => 'iphone 16e,آیفون ۱۶ ای',
                                        ],
                                    ],
                                ],
                                [
                                    'name' => 'iPhone 15',
                                    'description' => 'مدل‌های مختلف آیفون ۱۵',
                                    'tags' => 'iphone 15,آیفون ۱۵',
                                    'children' => [
                                        [
                                            'name' => 'iPhone 15 Pro',
                                            'description' => 'آیفون ۱۵ پرو',
                                            'tags' => 'iphone 15 pro,آیفون ۱۵ پرو',
                                        ],
                                        [
                                            'name' => 'iPhone 15 Pro Max',
                                            'description' => 'آیفون ۱۵ پرو مکس',
                                            'tags' => 'iphone 15 pro max,آیفون ۱۵ پرو مکس',
                                        ],
                                        [
                                            'name' => 'iPhone 15 Plus',
                                            'description' => 'آیفون ۱۵ پلاس',
                                            'tags' => 'iphone 15 plus,آیفون ۱۵ پلاس',
                                        ],
                                    ],
                                ],
                                [
                                    'name' => 'iPad',
                                    'description' => 'تبلت‌های اپل',
                                    'tags' => 'ipad,apple,تبلت',
                                ],
                                [
                                    'name' => 'Apple Watch',
                                    'description' => 'ساعت‌های هوشمند اپل',
                                    'tags' => 'apple watch,اپل واچ,smartwatch',
                                ],
                            ],
                        ],

                        // ==================== SAMSUNG ====================
                        [
                            'name' => 'Samsung',
                            'description' => 'محصولات و گوشی‌های سامسونگ',
                            'tags' => 'سامسونگ,samsung,galaxy',
                            'children' => [
                                [
                                    'name' => 'Galaxy S',
                                    'description' => 'سری پرچمدار Galaxy S',
                                    'tags' => 'galaxy s,samsung,s series',
                                    'children' => [
                                        [
                                            'name' => 'Galaxy S25',
                                            'description' => 'گوشی‌های سری Galaxy S25',
                                            'tags' => 's25,galaxy s25,samsung',
                                        ],
                                        [
                                            'name' => 'Galaxy S24',
                                            'description' => 'گوشی‌های سری Galaxy S24',
                                            'tags' => 's24,galaxy s24,samsung',
                                        ],
                                        [
                                            'name' => 'Galaxy S23',
                                            'description' => 'گوشی‌های سری Galaxy S23',
                                            'tags' => 's23,galaxy s23,samsung',
                                        ],
                                    ],
                                ],
                                [
                                    'name' => 'Galaxy A',
                                    'description' => 'سری Galaxy A سامسونگ',
                                    'tags' => 'galaxy a,samsung,a series',
                                    'children' => [
                                        [
                                            'name' => 'Galaxy A56',
                                            'description' => 'گوشی سامسونگ Galaxy A56',
                                            'tags' => 'a56,galaxy a56,samsung',
                                        ],
                                        [
                                            'name' => 'Galaxy A36',
                                            'description' => 'گوشی سامسونگ Galaxy A36',
                                            'tags' => 'a36,galaxy a36,samsung',
                                        ],
                                        [
                                            'name' => 'Galaxy A26',
                                            'description' => 'گوشی سامسونگ Galaxy A26',
                                            'tags' => 'a26,galaxy a26,samsung',
                                        ],
                                    ],
                                ],
                                [
                                    'name' => 'Galaxy Z',
                                    'description' => 'گوشی‌های تاشوی سامسونگ',
                                    'tags' => 'galaxy z,fold,flip,samsung',
                                    'children' => [
                                        [
                                            'name' => 'Galaxy Z Fold',
                                            'description' => 'گوشی‌های تاشوی سری Fold',
                                            'tags' => 'z fold,galaxy fold,samsung',
                                        ],
                                        [
                                            'name' => 'Galaxy Z Flip',
                                            'description' => 'گوشی‌های تاشوی سری Flip',
                                            'tags' => 'z flip,galaxy flip,samsung',
                                        ],
                                    ],
                                ],
                                [
                                    'name' => 'Galaxy Note',
                                    'description' => 'گوشی‌های سری Galaxy Note',
                                    'tags' => 'galaxy note,samsung,note',
                                ],
                                [
                                    'name' => 'Galaxy Tab',
                                    'description' => 'تبلت‌های سامسونگ',
                                    'tags' => 'galaxy tab,samsung,tablet',
                                ],
                                [
                                    'name' => 'Galaxy Watch',
                                    'description' => 'ساعت‌های هوشمند سامسونگ',
                                    'tags' => 'galaxy watch,samsung,smartwatch',
                                ],
                            ],
                        ],

                        // ==================== XIAOMI ====================
                        [
                            'name' => 'Xiaomi',
                            'description' => 'محصولات و گوشی‌های شیائومی',
                            'tags' => 'شیائومی,xiaomi,mi,redmi,poco',
                            'children' => [
                                [
                                    'name' => 'Xiaomi Series',
                                    'description' => 'گوشی‌های اصلی شیائومی',
                                    'tags' => 'xiaomi,mi series',
                                    'children' => [
                                        [
                                            'name' => 'Xiaomi 15',
                                            'description' => 'گوشی شیائومی ۱۵',
                                            'tags' => 'xiaomi 15,شیائومی ۱۵',
                                        ],
                                        [
                                            'name' => 'Xiaomi 14',
                                            'description' => 'گوشی شیائومی ۱۴',
                                            'tags' => 'xiaomi 14,شیائومی ۱۴',
                                        ],
                                    ],
                                ],
                                [
                                    'name' => 'Redmi',
                                    'description' => 'گوشی‌های سری Redmi',
                                    'tags' => 'redmi,xiaomi',
                                    'children' => [
                                        [
                                            'name' => 'Redmi Note',
                                            'description' => 'گوشی‌های سری Redmi Note',
                                            'tags' => 'redmi note,xiaomi',
                                        ],
                                        [
                                            'name' => 'Redmi Note 14',
                                            'description' => 'گوشی‌های Redmi Note 14',
                                            'tags' => 'redmi note 14',
                                        ],
                                        [
                                            'name' => 'Redmi Note 13',
                                            'description' => 'گوشی‌های Redmi Note 13',
                                            'tags' => 'redmi note 13',
                                        ],
                                    ],
                                ],
                                [
                                    'name' => 'Poco',
                                    'description' => 'گوشی‌های سری Poco',
                                    'tags' => 'poco,xiaomi',
                                    'children' => [
                                        [
                                            'name' => 'Poco F Series',
                                            'description' => 'گوشی‌های سری Poco F',
                                            'tags' => 'poco f,xiaomi',
                                        ],
                                        [
                                            'name' => 'Poco X Series',
                                            'description' => 'گوشی‌های سری Poco X',
                                            'tags' => 'poco x,xiaomi',
                                        ],
                                        [
                                            'name' => 'Poco M Series',
                                            'description' => 'گوشی‌های سری Poco M',
                                            'tags' => 'poco m,xiaomi',
                                        ],
                                    ],
                                ],
                            ],
                        ],

                        // ==================== HONOR ====================
                        [
                            'name' => 'Honor',
                            'description' => 'گوشی‌های هوشمند آنر',
                            'tags' => 'آنر,honor',
                            'children' => [
                                [
                                    'name' => 'Honor Magic',
                                    'description' => 'سری Honor Magic',
                                    'tags' => 'honor magic',
                                    'children' => [
                                        [
                                            'name' => 'Magic Pro',
                                            'description' => 'گوشی‌های Honor Magic Pro',
                                            'tags' => 'honor magic pro',
                                        ],
                                        [
                                            'name' => 'Magic V',
                                            'description' => 'گوشی‌های تاشوی Honor Magic V',
                                            'tags' => 'honor magic v,fold',
                                        ],
                                    ],
                                ],
                                [
                                    'name' => 'Honor X Series',
                                    'description' => 'گوشی‌های سری Honor X',
                                    'tags' => 'honor x series',
                                ],
                            ],
                        ],

                        // ==================== MOTOROLA ====================
                        [
                            'name' => 'Motorola',
                            'description' => 'محصولات و گوشی‌های موتورولا',
                            'tags' => 'موتورولا,motorola',
                            'children' => [
                                [
                                    'name' => 'Motorola Edge',
                                    'description' => 'گوشی‌های سری Motorola Edge',
                                    'tags' => 'motorola edge',
                                    'children' => [
                                        [
                                            'name' => 'Edge 50',
                                            'description' => 'گوشی موتورولا Edge 50',
                                            'tags' => 'motorola edge 50',
                                        ],
                                        [
                                            'name' => 'Edge 40',
                                            'description' => 'گوشی موتورولا Edge 40',
                                            'tags' => 'motorola edge 40',
                                        ],
                                    ],
                                ],
                                [
                                    'name' => 'Moto G',
                                    'description' => 'گوشی‌های سری Moto G',
                                    'tags' => 'moto g,motorola',
                                    'children' => [
                                        [
                                            'name' => 'Moto G Power',
                                            'description' => 'گوشی‌های سری Moto G Power',
                                            'tags' => 'moto g power',
                                        ],
                                        [
                                            'name' => 'Moto G Stylus',
                                            'description' => 'گوشی‌های سری Moto G Stylus',
                                            'tags' => 'moto g stylus',
                                        ],
                                    ],
                                ],
                            ],
                        ],

                        // ==================== GOOGLE ====================
                        [
                            'name' => 'Google Pixel',
                            'description' => 'گوشی‌های هوشمند Google Pixel',
                            'tags' => 'google,pixel,گوگل پیکسل',
                            'children' => [
                                [
                                    'name' => 'Pixel Series',
                                    'description' => 'سری گوشی‌های Google Pixel',
                                    'tags' => 'pixel,google',
                                    'children' => [
                                        [
                                            'name' => 'Pixel 9',
                                            'description' => 'گوشی‌های سری Google Pixel 9',
                                            'tags' => 'pixel 9,google',
                                        ],
                                        [
                                            'name' => 'Pixel 8',
                                            'description' => 'گوشی‌های سری Google Pixel 8',
                                            'tags' => 'pixel 8,google',
                                        ],
                                    ],
                                ],
                                [
                                    'name' => 'Pixel Pro',
                                    'description' => 'مدل‌های حرفه‌ای Pixel',
                                    'tags' => 'pixel pro,google',
                                ],
                            ],
                        ],

                        // ==================== ONEPLUS ====================
                        [
                            'name' => 'OnePlus',
                            'description' => 'گوشی‌های هوشمند وان‌پلاس',
                            'tags' => 'وان پلاس,oneplus',
                            'children' => [
                                [
                                    'name' => 'OnePlus Number Series',
                                    'description' => 'سری اصلی گوشی‌های OnePlus',
                                    'tags' => 'oneplus number series',
                                    'children' => [
                                        [
                                            'name' => 'OnePlus 13',
                                            'description' => 'گوشی OnePlus 13',
                                            'tags' => 'oneplus 13',
                                        ],
                                        [
                                            'name' => 'OnePlus 12',
                                            'description' => 'گوشی OnePlus 12',
                                            'tags' => 'oneplus 12',
                                        ],
                                    ],
                                ],
                                [
                                    'name' => 'OnePlus Nord',
                                    'description' => 'گوشی‌های اقتصادی OnePlus Nord',
                                    'tags' => 'oneplus nord',
                                ],
                            ],
                        ],

                        // ==================== MOBILE ACCESSORIES ====================
                        [
                            'name' => 'لوازم جانبی موبایل',
                            'description' => 'انواع لوازم جانبی و تجهیزات موبایل',
                            'tags' => 'لوازم جانبی موبایل,accessories,mobile',
                            'children' => [
                                [
                                    'name' => 'شارژر و کابل',
                                    'description' => 'انواع شارژر، آداپتور و کابل',
                                    'tags' => 'شارژر,کابل,آداپتور,charger,cable',
                                    'children' => [
                                        [
                                            'name' => 'شارژر دیواری',
                                            'description' => 'انواع شارژر دیواری',
                                            'tags' => 'شارژر دیواری,wall charger',
                                        ],
                                        [
                                            'name' => 'کابل شارژ',
                                            'description' => 'انواع کابل شارژ',
                                            'tags' => 'کابل شارژ,usb cable',
                                        ],
                                        [
                                            'name' => 'شارژر بی سیم',
                                            'description' => 'انواع شارژرهای بی‌سیم',
                                            'tags' => 'شارژر بی سیم,wireless charger',
                                        ],
                                    ],
                                ],
                                [
                                    'name' => 'قاب و گلس',
                                    'description' => 'انواع قاب، کاور و محافظ صفحه',
                                    'tags' => 'قاب,کاور,گلس,محافظ صفحه',
                                    'children' => [
                                        [
                                            'name' => 'قاب آیفون',
                                            'description' => 'قاب و کاور مخصوص آیفون',
                                            'tags' => 'قاب آیفون,iphone case',
                                        ],
                                        [
                                            'name' => 'قاب سامسونگ',
                                            'description' => 'قاب و کاور مخصوص سامسونگ',
                                            'tags' => 'قاب سامسونگ,samsung case',
                                        ],
                                        [
                                            'name' => 'محافظ صفحه',
                                            'description' => 'انواع گلس و محافظ صفحه',
                                            'tags' => 'گلس,محافظ صفحه,screen protector',
                                        ],
                                    ],
                                ],
                                [
                                    'name' => 'پاوربانک',
                                    'description' => 'انواع پاوربانک و شارژر همراه',
                                    'tags' => 'پاوربانک,powerbank',
                                    'children' => [
                                        [
                                            'name' => 'پاوربانک ظرفیت بالا',
                                            'description' => 'پاوربانک‌های با ظرفیت بالا',
                                            'tags' => 'پاوربانک,high capacity',
                                        ],
                                        [
                                            'name' => 'پاوربانک فست شارژ',
                                            'description' => 'پاوربانک‌های دارای شارژ سریع',
                                            'tags' => 'پاوربانک,fast charge',
                                        ],
                                    ],
                                ],
                                [
                                    'name' => 'هندزفری و هدفون',
                                    'description' => 'انواع هندزفری، ایرباد و هدفون',
                                    'tags' => 'هندزفری,هدفون,ایرباد,earbuds,headphone',
                                    'children' => [
                                        [
                                            'name' => 'هندزفری بی سیم',
                                            'description' => 'انواع هندزفری و ایرباد بی‌سیم',
                                            'tags' => 'هندزفری بی سیم,wireless earbuds',
                                        ],
                                        [
                                            'name' => 'هدفون بلوتوثی',
                                            'description' => 'انواع هدفون بلوتوثی',
                                            'tags' => 'هدفون,بلوتوث,bluetooth headphone',
                                        ],
                                    ],
                                ],
                                [
                                    'name' => 'تجهیزات خودرو',
                                    'description' => 'لوازم جانبی موبایل و شارژر خودرو',
                                    'tags' => 'لوازم خودرو,شارژر خودرو,car accessories',
                                    'children' => [
                                        [
                                            'name' => 'شارژر فندکی',
                                            'description' => 'انواع شارژر فندکی خودرو',
                                            'tags' => 'شارژر فندکی,car charger',
                                        ],
                                        [
                                            'name' => 'هولدر موبایل',
                                            'description' => 'انواع پایه و هولدر موبایل خودرو',
                                            'tags' => 'هولدر موبایل,car holder',
                                        ],
                                    ],
                                ],
                            ],
                        ],

                        // ==================== MOBILE TYPES ====================
                        [
                            'name' => 'گوشی اقتصادی',
                            'description' => 'گوشی‌های اقتصادی و مقرون‌به‌صرفه',
                            'tags' => 'گوشی اقتصادی,budget phone',
                            'children' => [
                                [
                                    'name' => 'زیر ۱۰ میلیون',
                                    'description' => 'گوشی‌های اقتصادی زیر ۱۰ میلیون تومان',
                                    'tags' => 'گوشی زیر ۱۰ میلیون,budget',
                                ],
                                [
                                    'name' => '۱۰ تا ۲۰ میلیون',
                                    'description' => 'گوشی‌های اقتصادی بین ۱۰ تا ۲۰ میلیون تومان',
                                    'tags' => 'گوشی اقتصادی,10-20 million',
                                ],
                            ],
                        ],

                        [
                            'name' => 'گوشی پرچمدار',
                            'description' => 'جدیدترین گوشی‌های پرچمدار',
                            'tags' => 'پرچمدار,flagship,premium phone',
                            'children' => [
                                [
                                    'name' => 'پرچمدار Apple',
                                    'description' => 'گوشی‌های پرچمدار اپل',
                                    'tags' => 'apple,iphone,flagship',
                                ],
                                [
                                    'name' => 'پرچمدار Samsung',
                                    'description' => 'گوشی‌های پرچمدار سامسونگ',
                                    'tags' => 'samsung,galaxy,flagship',
                                ],
                                [
                                    'name' => 'پرچمدار Xiaomi',
                                    'description' => 'گوشی‌های پرچمدار شیائومی',
                                    'tags' => 'xiaomi,flagship',
                                ],
                            ],
                        ],

                        [
                            'name' => 'گوشی گیمینگ',
                            'description' => 'گوشی‌های مخصوص بازی و گیمینگ',
                            'tags' => 'گیمینگ,gaming phone',
                            'children' => [
                                [
                                    'name' => 'ROG Phone',
                                    'description' => 'گوشی‌های گیمینگ Asus ROG',
                                    'tags' => 'rog phone,asus,gaming',
                                ],
                                [
                                    'name' => 'RedMagic',
                                    'description' => 'گوشی‌های گیمینگ RedMagic',
                                    'tags' => 'redmagic,gaming phone',
                                ],
                            ],
                        ],
                    ],
                ],

                [
                    'name' => 'عطر و اتکلون',
                    'description' => 'انواع عطر، ادکلن و محصولات خوشبوکننده',
                    'tags' => 'عطر,ادکلن,perfume,cologne',
                    'show_in_menu' => true,
                    'children' => [
                        [
                            'name' => 'Dior',
                            'description' => 'محصولات عطر و ادکلن دیور',
                            'tags' => 'dior,دیور,perfume',
                            'children' => [
                                [
                                    'name' => 'Dior Sauvage',
                                    'description' => 'محصولات سری Dior Sauvage',
                                    'tags' => 'dior sauvage,sauvage,دیور ساواج',
                                ],
                            ],
                        ],
                        [
                            'name' => 'عطر مردانه',
                            'description' => 'انواع عطر و ادکلن مردانه',
                            'tags' => 'عطر مردانه,ادکلن مردانه,men perfume',
                        ],
                        [
                            'name' => 'عطر زنانه',
                            'description' => 'انواع عطر و ادکلن زنانه',
                            'tags' => 'عطر زنانه,ادکلن زنانه,women perfume',
                        ],
                    ],
                ],

                [
                    'name' => 'Sexy Man',
                    'description' => 'محصولات و کالاهای مرتبط با آقایان',
                    'tags' => 'مردانه,آقایان,men',
                    'show_in_menu' => false,
                    'children' => [
                        [
                            'name' => 'پوشاک مردانه',
                            'description' => 'انواع پوشاک مردانه',
                            'tags' => 'پوشاک مردانه,لباس مردانه,men clothing',
                        ],
                        [
                            'name' => 'اکسسوری مردانه',
                            'description' => 'انواع اکسسوری مردانه',
                            'tags' => 'اکسسوری مردانه,men accessories',
                        ],
                    ],
                ],

                [
                    'name' => 'کتاب لوازم تحریر و هنر',
                    'description' => 'کتاب، لوازم تحریر و محصولات هنری',
                    'tags' => 'کتاب,لوازم تحریر,هنر,book,stationery,art',
                    'show_in_menu' => true,
                    'children' => [
                        [
                            'name' => 'کتاب',
                            'description' => 'انواع کتاب',
                            'tags' => 'کتاب,book',
                            'children' => [
                                [
                                    'name' => 'کتاب رمان',
                                    'description' => 'انواع کتاب‌های رمان',
                                    'tags' => 'رمان,داستان,novel',
                                ],
                                [
                                    'name' => 'کتاب آموزشی',
                                    'description' => 'کتاب‌های آموزشی و تخصصی',
                                    'tags' => 'کتاب آموزشی,education',
                                ],
                            ],
                        ],
                        [
                            'name' => 'لوازم تحریر',
                            'description' => 'انواع لوازم تحریر',
                            'tags' => 'لوازم تحریر,stationery',
                        ],
                        [
                            'name' => 'لوازم هنری',
                            'description' => 'ابزار و لوازم مورد نیاز هنر',
                            'tags' => 'لوازم هنری,art supplies',
                        ],
                    ],
                ],

                [
                    'name' => 'اسباب بازی کودک و نوزاد',
                    'description' => 'انواع اسباب بازی و محصولات کودک و نوزاد',
                    'tags' => 'اسباب بازی,کودک,نوزاد,toys,baby,kids',
                    'show_in_menu' => true,
                    'children' => [
                        [
                            'name' => 'اسباب بازی پسرانه',
                            'description' => 'انواع اسباب بازی مناسب کودکان پسر',
                            'tags' => 'اسباب بازی پسرانه,boys toys',
                        ],
                        [
                            'name' => 'اسباب بازی دخترانه',
                            'description' => 'انواع اسباب بازی مناسب کودکان دختر',
                            'tags' => 'اسباب بازی دخترانه,girls toys',
                        ],
                        [
                            'name' => 'اسباب بازی فکری',
                            'description' => 'انواع بازی‌های فکری و آموزشی',
                            'tags' => 'بازی فکری,اسباب بازی آموزشی,educational toys',
                        ],
                    ],
                ],

                [
                    'name' => 'کالاهای سوپرمارکتی',
                    'description' => 'انواع کالاهای مصرفی و سوپرمارکتی',
                    'tags' => 'سوپرمارکت,مواد غذایی,supermarket,grocery',
                    'show_in_menu' => true,
                    'children' => [
                        [
                            'name' => 'مواد غذایی',
                            'description' => 'انواع مواد غذایی',
                            'tags' => 'مواد غذایی,grocery,food',
                            'children' => [
                                [
                                    'name' => 'تنقلات',
                                    'description' => 'انواع تنقلات',
                                    'tags' => 'تنقلات,snacks',
                                ],
                                [
                                    'name' => 'نوشیدنی',
                                    'description' => 'انواع نوشیدنی',
                                    'tags' => 'نوشیدنی,drinks',
                                ],
                            ],
                        ],
                        [
                            'name' => 'شوینده و بهداشتی',
                            'description' => 'انواع محصولات شوینده و بهداشتی',
                            'tags' => 'شوینده,بهداشتی,cleaning',
                        ],
                    ],
                ],

                [
                    'name' => 'زیبایی و سلامت',
                    'description' => 'محصولات زیبایی، مراقبت شخصی و سلامت',
                    'tags' => 'زیبایی,سلامت,beauty,health',
                    'show_in_menu' => true,
                    'children' => [
                        [
                            'name' => 'مراقبت پوست',
                            'description' => 'محصولات مراقبت از پوست',
                            'tags' => 'مراقبت پوست,skincare',
                            'children' => [
                                [
                                    'name' => 'کرم و مرطوب کننده',
                                    'description' => 'انواع کرم و محصولات مرطوب کننده',
                                    'tags' => 'کرم,مرطوب کننده,moisturizer',
                                ],
                            ],
                        ],
                        [
                            'name' => 'مراقبت مو',
                            'description' => 'محصولات مراقبت از مو',
                            'tags' => 'مراقبت مو,hair care',
                        ],
                        [
                            'name' => 'لوازم آرایشی',
                            'description' => 'انواع محصولات آرایشی',
                            'tags' => 'آرایش,لوازم آرایشی,cosmetics',
                        ],
                    ],
                ],

                [
                    'name' => 'خانه و آشپزخانه',
                    'description' => 'انواع کالاهای خانه، آشپزخانه و لوازم منزل',
                    'tags' => 'خانه,آشپزخانه,home,kitchen',
                    'show_in_menu' => true,
                    'children' => [
                        [
                            'name' => 'لوازم آشپزخانه',
                            'description' => 'انواع لوازم مورد نیاز آشپزخانه',
                            'tags' => 'لوازم آشپزخانه,kitchen',
                            'children' => [
                                [
                                    'name' => 'ظروف آشپزخانه',
                                    'description' => 'انواع ظروف آشپزخانه',
                                    'tags' => 'ظروف,آشپزخانه,dishes',
                                ],
                                [
                                    'name' => 'ابزار آشپزی',
                                    'description' => 'انواع ابزار آشپزی',
                                    'tags' => 'ابزار آشپزی,cooking tools',
                                ],
                            ],
                        ],
                        [
                            'name' => 'دکوراسیون',
                            'description' => 'انواع محصولات دکوراسیون منزل',
                            'tags' => 'دکوراسیون,خانه,decoration',
                        ],
                    ],
                ],

                [
                    'name' => 'ورزش و سفر',
                    'description' => 'محصولات ورزشی، کمپینگ و سفر',
                    'tags' => 'ورزش,سفر,کمپینگ,sport,travel,camping',
                    'show_in_menu' => true,
                    'children' => [
                        [
                            'name' => 'ورزش',
                            'description' => 'انواع تجهیزات و لوازم ورزشی',
                            'tags' => 'ورزش,تجهیزات ورزشی,sport',
                            'children' => [
                                [
                                    'name' => 'بدنسازی',
                                    'description' => 'تجهیزات و لوازم بدنسازی',
                                    'tags' => 'بدنسازی,fitness,gym',
                                ],
                                [
                                    'name' => 'فوتبال',
                                    'description' => 'محصولات و تجهیزات فوتبال',
                                    'tags' => 'فوتبال,football',
                                ],
                            ],
                        ],
                        [
                            'name' => 'کمپینگ و کوهنوردی',
                            'description' => 'تجهیزات کمپینگ و کوهنوردی',
                            'tags' => 'کمپینگ,کوهنوردی,camping,hiking',
                        ],
                    ],
                ],
            ];

            $this->createCategories($categories, null, $image);
        });
    }

    private function createCategories(array $categories, ?int $parentId, array $image): void
    {
        foreach ($categories as $category) {
            $slug = $category['slug'] ?? \Illuminate\Support\Str::slug($category['name'], '-');

            $model = ProductCategory::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $category['name'],
                    'description' => $category['description'] ?? null,
                    'slug' => $slug,
                    'image' => json_encode($image, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                    'status' => $category['status'] ?? true,
                    'show_in_menu' => $category['show_in_menu'] ?? true,
                    'tags' => $category['tags'] ?? null,
                    'parent_id' => $parentId,
                ]
            );

            if (!empty($category['children'])) {
                $this->createCategories($category['children'], $model->id, $image);
            }
        }
    }
}
