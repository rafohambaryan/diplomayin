<?php

namespace App\Http\Controllers;

use App\Models\Present;
use Illuminate\Http\Request;

class PresentController extends Controller
{
    public function index($token)
    {
        $present = Present::where('url', $token)->first();
        if (!$present) {
            return redirect()->to('/');
        }
        return view('front.pages.index', ['mainSlide' => $present->mainSlide]);
    }
}
