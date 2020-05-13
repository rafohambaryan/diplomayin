<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
        $orders = Order::where('present_id', $present->id)->orderBy('order', 'ASC')->get();
        return view('front.pages.index', ['mainSlide' => $present->mainSlide, 'orders' => $orders]);
    }
}
