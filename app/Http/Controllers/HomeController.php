<?php

namespace App\Http\Controllers;

use App\Models\Present;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index($token)
    {
        $present = Present::where('url', $token)->first();
        if (!$present || !Auth::check()) {
            return redirect()->to('/');
        }
        return view('pages.present', ['mainSlide' => $present->mainSlide]);
    }
}
