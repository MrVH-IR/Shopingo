<?php

namespace Common\Services\Home\Action;

use App\Models\Content\Banner;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use Illuminate\Support\Facades\Cache;

class HomePageService
{

    public function getHomePage(): array
    {
        return [
            'banners'          => $this->getBanners(),
            'brands'           => $this->getBrands(),
            'products'         => $this->getProducts(),
            'getOfferProducts' => $this->getOfferProducts(),
        ];
    }

    private function getBanners()
    {
        return Cache::remember(
            'banners',
            now()->addHour(),
            fn () => Banner::query()
                ->where('status', 1)
                ->get()
                ->groupBy('position')
        );
    }

    private function getBrands()
    {
        // TO-DO Most Visited
        return Cache::remember(
            'brands',
            now()->addHour(),
            fn () => Brand::where('status' , 1)->get()
        );
    }

    private function getProducts()
    {
        // TO-DO Most Visited
        return Cache::remember(
            'products',
            now()->addHour(),
            fn () => Product::query()
                ->latest()
                ->take(10)
                ->get()
        );
    }

    private function getOfferProducts()
    {
        return Cache::remember(
            'offerProducts',
            now()->addHour(),
            fn () => Product::query()
                ->latest()
                ->take(10)
                ->get()
        );
    }
}
