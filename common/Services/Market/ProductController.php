<?php

namespace Common\Services\Market;

use App\Http\Controllers\Controller;
use App\Models\Content\Comment;
use App\Models\Market\Compare;
use App\Models\Market\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends BaseController
{

    use ProductService;

    public function product(Product $product): View
    {
        $key = "relatedProducts:{$product->id}";
        $relatedProducts = Cache::remember($key, now()->addHours(2), function () use ($product) {
            return Product::query()
                ->where(function ($q) use ($product) {
                    $q->where('brand_id', $product->brand_id)
                        ->orWhere('product_categories', $product->product_categories);
                })
                ->whereKeyNot($product->id)
                ->latest()
                ->take(10)
                ->get();
        });
        self::incrementView($product);
        $isCompared = $this->isCompared($product);
        return view('customer.market.product.product' , ['product' => $product , 'relatedProducts' => $relatedProducts, 'isCompared' => $isCompared,]);
    }

    public function addComment(Product $product , CommentRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $body = str_replace(PHP_EOL , '</br>' , $request->comment);
        $author = Auth::user()->id;
        $product = $product->id;
        $commentable = Product::class;
        $success = self::createComment($body , $author, $commentable, $product);
        if (!$success) { return back()->with('swal-error', 'اختلال در سیستم به وجود آمده است. لطفا بعدا تلاش فرمایید'); }
        return back()->with('swal-success' , 'نظر شما ثبت شد. بعد از تایید مدیریت در سایت قرار داده خواهد شد.');
    }

    public function toggleFavorite(Product $product): JsonResponse
    {
        $user = Auth::user();

        $isFavorite = self::createFavorite($product, $user);

        return response()->json([
            'success' => true,
            'action'  => $isFavorite ? 'added' : 'removed',
            'message' => $isFavorite
                ? 'محصول به علاقه‌مندی‌ها اضافه شد.'
                : 'محصول از علاقه‌مندی‌ها حذف شد.',
        ]);
    }

    public function compareProduct(Product $product): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'auth' => false], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        $compare = $user->compare()->firstOrCreate();

        $isCompared = $compare->products()->whereKey($product->id)->exists();

        if ($isCompared) {
            $compare->products()->detach($product->id);
            $action = 'removed';
            $message = 'محصول از لیست مقایسه حذف شد.';
        } else {
            $compare->products()->attach($product->id);
            $action = 'added';
            $message = 'محصول به لیست مقایسه اضافه شد.';
        }

        return response()->json([
            'success' => true,
            'action' => $action,
            'message' => $message,
        ]);
    }

    private function isCompared(Product $product): bool
    {
        $compare = Auth::user()?->compare;

        return $compare?->products()->whereKey($product->id)->exists() ?? false;
    }
}
