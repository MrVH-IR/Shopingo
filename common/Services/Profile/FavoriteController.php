<?php

namespace Common\Services\Profile;

use App\Models\Market\Product;
use Common\Services\Response\Responses;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FavoriteController extends BaseController
{
    public function index(): View
    {
        return view('customer.profile.my-favorites');
    }

    public function delete(Product $product): RedirectResponse
    {
        auth()->user()->favoriteProducts()->detach($product->id);
        return Responses::redirectToWith('customer.profile.my-favorites','success', 'موفق', 'محصول مورد نظر از لیست علاقه مندی شما حذف شد');
    }
}
