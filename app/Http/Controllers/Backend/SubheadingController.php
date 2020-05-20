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
        return response()->json(['success' => true, 'data' => $this->interfaces->createUpdate($data, $img)], 200);
    }
}
