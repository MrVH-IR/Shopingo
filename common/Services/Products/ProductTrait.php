<?php

namespace Common\Services\Products;

use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

trait ProductTrait
{

    protected function sortOrder(int $number): array
    {
        return match ($number) {
            1 => ['created_at', 'DESC'],
            2 => ['price', 'DESC'],
            3 => ['price', 'ASC'],
            4 => ['view', 'DESC'],
            5 => ['sold_out', 'DESC'],
            default => ['created_at', 'DESC'],
        };
    }

    protected function getBrands(): Collection
    {
        $key = 'brands:products:search';
        return Cache::remember($key, now()->addHour(), fn() => Brand::query()->select(['id','persian_name', 'original_name'])->latest()->get());
    }

    protected function applyProductFilters(Builder $query, ?ProductCategory $productCategory = null): Builder
    {
        $this->applySearchFilter($query);
        $this->applyPriceFilter($query);
        $this->applyBrandFilter($query);
        $this->applyFavoriteState($query);
        $this->applySort($query);
        $this->applyCategoryFilter($query , $productCategory);

        return $query;
    }

    protected function applySearchFilter(Builder $query): void
    {
        $query->when(request()->filled('search'), function ($query) {
            $search = request()->query('search');

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('tags', 'like', "%{$search}%");
            });
        });
    }

    protected function applyPriceFilter(Builder $query): void
    {
        $query
            ->when(request()->filled('min_price'), function ($query) {
                $query->where(
                    'price',
                    '>=',
                    request()->query('min_price')
                );
            })
            ->when(request()->filled('max_price'), function ($query) {
                $query->where(
                    'price',
                    '<=',
                    request()->query('max_price')
                );
            });
    }

    protected function applySort(Builder $query): void
    {
        if (request()->filled('sort')) {
            [$column, $direction] = $this->sortOrder(
                (int) request()->query('sort')
            );

            $query->orderBy($column, $direction);
        }
    }

    protected function applyBrandFilter(Builder $query): void
    {
        $query->when(request()->filled('brand'), function ($query) {
            $brands = (array) request()->query('brand');

            $query->whereIn('brand_id', $brands);
        });
    }

    protected function applyFavoriteState(Builder $query): void
    {
        if (!auth()->check()) {
            return;
        }

        $query->withExists([
            'user as is_favorite' => fn($query) => $query->whereKey(auth()->id()),
        ]);
    }

    protected function applyCategoryFilter(Builder $query, ?ProductCategory $category = null): void
    {
        if (!$category) return;
        $query->where('product_categories', $category->id);
    }

    protected function searchResult(string $search): Collection|\Illuminate\Support\Collection
    {
        return Product::query()
            ->select([
                'id',
                'name',
                'slug',
                'price',
                'image',
            ])
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('tags', 'like', "%{$search}%");
            })
            ->limit(5)
            ->get()
            ->map(function ($product) {
                $image = data_get($product->image, 'indexArray.medium');

                return [
                    'name'  => $product->name,
                    'slug'  => $product->slug,
                    'price' => $product->price,
                    'image' => $image ? asset($image) : null,
                    'url'   => route('customer.market.product', $product->slug),
                ];
            });
    }

    protected function getProductCategories(): Collection
    {
        $key = 'categories:products:search';

        return Cache::remember(
            $key,
            now()->addHour(),
            fn() => ProductCategory::query()
                ->select(['id', 'name'])
                ->active()
                ->get()
        );
    }
}
