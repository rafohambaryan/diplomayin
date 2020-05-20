<?php


namespace App\Services\Backend;


use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderService extends Order
{
    protected $table = 'orders';

    public function get($id, $sort)
    {
        return $this->where('present_id', $id)->where('user_id', Auth::id())->orderBy('order', $sort)->get();
    }

    public function createOrder($subheading_id, $present_id)
    {
        return $this->create([
            'user_id' => Auth::id(),
            'present_id' => $present_id,
            'subheading_id' => "$subheading_id",
            'order' => $subheading_id
        ]);
    }
}
