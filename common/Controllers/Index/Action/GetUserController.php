<?php

namespace Common\Controllers\Index\Action;

use Common\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;


class GetUserController extends BaseController {
    
    protected $ip;
    protected $header;
    public function __construct($ip, $header)
    {
        $this->ip = $ip;
        $this->header = $header;
    }

    public function __invoke(): array
    {
        if (Auth::user()) {
            return [
                "IP" => $this->ip,
                "header" => $this->header,
                "user" => Auth::user()->only(["id", "name", "email"])
            ];
        }
        return [
            "IP" => $this->ip,
            "header" => $this->header,
        ];
    }
}