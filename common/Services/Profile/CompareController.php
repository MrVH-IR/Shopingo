<?php

namespace Common\Services\Profile;

use App\Http\Controllers\Controller;
use Common\Services\Profile\Traits\Compare;

class CompareController extends Controller
{
    use Compare;

    public function index()
    {
        return $this->compareLists();
    }
}
