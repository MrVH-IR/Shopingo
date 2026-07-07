<?php

namespace Common\Services\Home;

use Common\Services\Home\Action\HomePageService;
use Common\Services\Home\Jobs\StoreUserCyberDataJob;

class HomeController extends BaseController {

    public function index(HomePageService $homePageService)
    {
        dispatch(new StoreUserCyberDataJob(request()->ip(), request()->headers->all(), auth()->id()))->onQueue('cyber_data');
        $homePage = $homePageService->getHomePage();
        return view('customer.home' , compact('homePage'));
    }
}
