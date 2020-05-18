<?php


namespace App\Repository\Backend;


use App\Repository\Backend\Interfaces\SubheadingManyRepositoryInterface;
use App\Services\Backend\PostService;
use App\Services\Backend\SubheadingManyService;

class SubheadingManyRepository implements SubheadingManyRepositoryInterface
{
    protected $services;
    protected $present;

    public function __construct(SubheadingManyService $services, PostService $present)
    {
        $this->services = $services;
        $this->present = $present;
    }

    public function get($present_id, $sub_id)
    {
        $present = $this->present->getFind($present_id);
        if ($present) {
            return current($this->services->get($present, $sub_id));
        }
        return [];
    }
}
