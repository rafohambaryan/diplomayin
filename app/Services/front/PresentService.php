<?php


namespace App\Services\front;


use App\Models\Order;
use App\Models\Present;

class PresentService
{
    private $present;
    private $order;

    /**
     * PresentService constructor.
     * @param Present $present
     * @param Order $order
     */
    public function __construct(Present $present, Order $order)
    {
        $this->present = $present;
        $this->order = $order;
    }

    /**
     * @param $token
     * @return Present
     */
    public function getPresent($token): Present
    {
        return $this->present->where('url', $token)->first();
    }

    /**
     * @param $present_id
     * @return mixed
     */
    public function getOrders($present_id)
    {
        return $this->order->where('present_id', $present_id)->orderBy('order', 'ASC')->get();
    }
}
