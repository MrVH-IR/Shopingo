<?php

namespace Common\Controllers\Home;

use Common\Controllers\Home\Action\HomePageService;
use Common\Controllers\Home\Jobs\StoreUserCyberDataJob;

class HomeController extends BaseController {

    public function index(HomePageService $homePageService)
    {
        dispatch(new StoreUserCyberDataJob(request()->ip(), request()->headers->all(), auth()->id()))->onQueue('cyber_data');
        $homePage = $homePageService->getHomePage();
        return view('customer.home' , compact('homePage'));
    }
}
