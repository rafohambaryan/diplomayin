<?php

namespace App\Http\Controllers\Backend;

use App\Repository\Backend\Interfaces\SubheadingRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubheadingController extends Controller
{
    protected $interfaces;

    public function __construct(SubheadingRepositoryInterface $interfaces)
    {
        $this->interfaces = $interfaces;
    }

    public function get($present_id, $sub_id)
    {
        return $this->interfaces->get($present_id, $sub_id);
    }
}
