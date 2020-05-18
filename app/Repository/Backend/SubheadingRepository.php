<?php


namespace App\Repository\Backend;


use App\Repository\Backend\Interfaces\SubheadingRepositoryInterface;
use App\Services\Backend\PostService;
use App\Services\Backend\SubheadingServices;

class SubheadingRepository implements SubheadingRepositoryInterface
{
    protected $services;
    protected $present;

    public function __construct(SubheadingServices $services, PostService $present)
    {
        $this->services = $services;
        $this->present = $present;
    }

    public function get($present_id, $sub_id)
    {
        $present = $this->present->getFind($present_id);
        if ($present) {
            dd($present);
        }
        return redirect()->back();
    }
}
