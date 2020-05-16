<?php


namespace App\Repository\front;

use App\Services\front\PresentService;

class PresentRepository extends PresentService
{

    /**
     * PresentRepository constructor.
     * @param PresentService $service
     */

    /**
     * @param $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($token)
    {
        $present = $this->getPresent($token);
        $orders = $this->getOrders($present->id);
        return view('front.pages.index', ['mainSlide' => $present->mainSlide, 'orders' => $orders]);
    }

    /**
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function colors($token)
    {
        $options = [];
        $present = $this->getPresent($token);
        $orders = $this->getOrders($present->id);
        $mainSlide['background'] = $present->mainSlide->background;
        $mainSlide['color'] = $present->mainSlide->color;
        $mainSlide['section_id'] = $present->url;
        foreach ($orders as $index => $order) {
            if (!empty($order->subheadings->many)) {
                foreach ($order->subheadings->many as $many) {
                    array_push($options, ['section_id' => $many->section_id, 'background' => $many->background, 'color' => $many->color]);
                }
            }
            array_push($options, ['section_id' => $order->subheadings->section_id, 'background' => $order->subheadings->background, 'color' => $order->subheadings->color]);
        }
        return response()->json(['success' => true, 'main' => $mainSlide, 'options' => $options], 200);
    }
}
