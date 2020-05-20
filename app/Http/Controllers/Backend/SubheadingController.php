<?php

namespace App\Http\Controllers\Backend;

use App\Repository\Backend\Interfaces\SubheadingManyRepositoryInterface;
use App\Repository\Backend\Interfaces\SubheadingRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubheadingController extends Controller
{
    protected $interfaces;
    protected $many;

    private $return;

    public function __construct(SubheadingRepositoryInterface $interfaces, SubheadingManyRepositoryInterface $many)
    {
        $this->interfaces = $interfaces;
        $this->many = $many;
    }

    public function get($sub_id)
    {
        return response()->json(['success' => true, 'data' => $this->interfaces->get($sub_id)]);
    }

    public function delete($sub_id)
    {
        return response()->json(['success' => $this->interfaces->delete($sub_id)], 200);
    }

    public function updateCreate(Request $request)
    {
        $img = null;
        $data = $request->all();
        if ($request->input('content-image-bool') == '1') {
            if ($request->has('content-img')) {
                $img = $request->file('content-img');
                unset($data['content-img']);
            }

        } else {
            $img = 'deleted';
        }
        if ($request->has('sub_many')) {
            $this->return = $this->many->createSubMany($data, $img);
            unset($data['sub_many']);
        } else {
            $this->return = $this->interfaces->createUpdate($data, $img);
        }
        return response()->json(['success' => true, 'data' => $this->return], 200);
    }
}
