<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $infofield;
    public $session;
    public function __construct() {
        $this->infofield;
        $this->session;
    }

    public function index() {
        return view('index');
    }
}