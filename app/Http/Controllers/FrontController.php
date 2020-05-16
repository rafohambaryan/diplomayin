<?php


namespace App\Http\Controllers;


class FrontController extends Controller
{
    public function __construct()
    {
        $this->middleware('throttle:30,1');
    }
}
