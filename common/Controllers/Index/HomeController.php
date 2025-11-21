<?php

namespace Common\Controllers\Index;

use Common\Controllers\Index\Action\GetUserController;
use Common\Models\UserCyberData;
use function Laravel\Prompts\error;

class HomeController extends BaseController {

    public function index()
    {
        $data = new GetUserController($ip = request()->ip() , $header = request()->header())();
        if (!UserCyberData::on("sqlite")->where('ip_address' , $data['IP'])->exists()) {
            UserCyberData::on("sqlite")->create([
                "ip_address" => $data['IP'] ?? null,
                "header"     => $data['header'] ?? null,
                "user_id"    => $data['user']['id'] ?? null,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ]);
        }

        return view('welcome');
    }
}
