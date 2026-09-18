<?php

namespace Common\Services\Products;

use App\Models\Market\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use \Illuminate\View\View as ViewAlias;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends BaseController
{

    use ProductTrait;

    public function index(): Factory|View|ViewAlias
    {
        $query = Product::query();
        $this->applyProductFilters($query);

        $products = $query
            ->paginate(20)
            ->withQueryString();

        $brands = $this->getBrands();
        $categories = $this->getProductCategories();
        return view('customer.products.products', compact('products', 'brands', 'categories')
        );
    }

    public function search(Request $request): JsonResponse
    {
        $search = trim((string) $request->input('search'));

        if (blank($search)) {
            return response()->json([]);
        }

        $products = $this->searchResult($search);

        return response()->json($products);
    }

    public function sort(Request $request)
    {

    }


}
