<?php

namespace Database\Seeders\AppData;

use Common\Models\City;
use Common\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'تهران' => [
                'تهران',
                'ری',
                'شمیرانات',
                'اسلامشهر',
                'پردیس',
                'دماوند',
                'فیروزکوه',
            ],
            'البرز' => [
                'کرج',
                'فردیس',
                'نظرآباد',
                'ساوجبلاغ',
                'اشتهارد',
            ],
            'اصفهان' => [
                'اصفهان',
                'کاشان',
                'نجف‌آباد',
                'خمینی‌شهر',
                'شاهین‌شهر',
            ],
            'فارس' => [
                'شیراز',
                'مرودشت',
                'کازرون',
                'لار',
                'جهرم',
            ],
            'خراسان رضوی' => [
                'مشهد',
                'نیشابور',
                'سبزوار',
                'تربت حیدریه',
            ],
        ];

        foreach ($data as $provinceName => $cities) {

            $province = Province::where('name', $provinceName)->first();

            if (!$province) {
                continue;
            }

            foreach ($cities as $city) {
                City::firstOrCreate([
                    'name' => $city,
                    'province_id' => $province->id,
                ]);
            }
        }
    }
}
