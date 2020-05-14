<?php


namespace App\Repository\front;

use App\Services\front\PresentService;

class PresentRepository
{
    /**
     * @var PresentService
     */
    private $service;

    /**
     * PresentRepository constructor.
     * @param PresentService $service
     */
    public function __construct(PresentService $service)
    {
        $this->service = $service;
    }

    /**
     * @param $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($token)
    {
        $present = $this->service->getPresent($token);
        $orders = $this->service->getOrders($present->id);
        return view('front.pages.index', ['mainSlide' => $present->mainSlide, 'orders' => $orders]);
    }

    /**
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function colors($token)
    {
        $colors = [];
        $present = $this->service->getPresent($token);
        $orders = $this->service->getOrders($present->id);
        array_push($colors, $present->mainSlide->background);
        foreach ($orders as $index => $order) {
            array_push($colors, $order->subheadings->background);
        }
        return response()->json($colors, 200);
    }
}
