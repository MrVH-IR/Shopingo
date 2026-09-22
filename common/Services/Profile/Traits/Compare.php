<?php

namespace Common\Services\Profile\Traits;

trait Compare
{

    protected function compareLists()
    {
        $compare = auth()->user()->compare()->with('products')->first();

        $products = $compare?->products ?? collect();

        return view('customer.profile.my-compares', compact('products'));
    }
}
