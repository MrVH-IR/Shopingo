<?php

namespace Common\Services\Page;

use App\Models\Content\Page;
use Common\Services\Page\BaseController;

class PageController extends BaseController
{

    public function index(Page $page)
    {
        return view('customer.page.index', compact('page'));
    }

}
