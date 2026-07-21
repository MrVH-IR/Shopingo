<?php

namespace Common\Services\Products;

use App\Models\Market\Product;
use Illuminate\Http\Request;

class ProductController extends BaseController
{

    public function index()
    {
        $products = Product::query()
            ->when(request('search'), function ($query) {
                $search = request('search');

                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->paginate(20)
            ->withQueryString();

        return view('customer.products.products', compact('products'));
    }

    public function search(Request $request): \Illuminate\Http\JsonResponse
    {
        $search = trim((string) $request->input('search'));

        if (blank($search)) {
            return response()->json([]);
        }

        $products = Product::query()
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
                    ->orWhere('description', 'like', "%{$search}%");
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

        return response()->json($products);
    }
}
