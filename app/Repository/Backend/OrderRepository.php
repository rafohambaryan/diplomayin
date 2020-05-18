<?php


namespace App\Repository\Backend;


use App\Repository\Backend\Interfaces\OrderRepositoryInterface;
use App\Services\Backend\OrderService;

class OrderRepository implements OrderRepositoryInterface
{
    protected $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function get($id, $sort = 'ASC')
    {
        return $this->service->get($id, $sort);
    }
}
