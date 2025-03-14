<?php

namespace App\Http\Controllers;

use App\Models\HomeProduct;
// use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $infofield;
    public $session;
    public function __construct() {
        $this->infofield;
        $this->session;
    }

    public function index() {
            $first_div = HomeProduct::where('first_div', 'active')->get();
            $second_div = HomeProduct::where('second_div', 'active')->get();
            $third_div = HomeProduct::where('third_div', 'active')->get();

            return view('index', compact('first_div', 'second_div', 'third_div'));
    }
}
