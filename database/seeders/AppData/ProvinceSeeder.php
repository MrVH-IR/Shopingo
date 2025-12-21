<?php

namespace Database\Seeders\AppData;

use Common\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            'تهران',
            'البرز',
            'اصفهان',
            'فارس',
            'خراسان رضوی',
            'آذربایجان شرقی',
            'آذربایجان غربی',
            'گیلان',
            'مازندران',
            'خوزستان',
            'قم',
            'کرمان',
            'یزد',
            'کرمانشاه',
            'سیستان و بلوچستان',
            'هرمزگان',
            'همدان',
            'مرکزی',
            'قزوین',
            'گلستان',
            'اردبیل',
            'زنجان',
            'بوشهر',
            'چهارمحال و بختیاری',
            'کهگیلویه و بویراحمد',
            'ایلام',
            'لرستان',
            'کردستان',
            'سمنان',
            'خراسان شمالی',
            'خراسان جنوبی',
        ];

        foreach ($provinces as $province) {
            Province::firstOrCreate([
                'name' => $province
            ]);
        }
    }
}
