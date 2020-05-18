<?php

namespace App\Http\Controllers\Backend;

use App\Repository\Backend\Interfaces\SubheadingManyRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubheadingManyController extends Controller
{
    protected $interfaces;

    public function __construct(SubheadingManyRepositoryInterface $interfaces)
    {
        $this->interfaces = $interfaces;
    }

    public function get($present_id, $sub_id)
    {
        $sub_many = $this->interfaces->get($present_id, $sub_id);
        if (empty($sub_many)) {
            return redirect()->back();
        }
        return view('pages.subheading_manies', ['subs' => $sub_many]);
    }
}
