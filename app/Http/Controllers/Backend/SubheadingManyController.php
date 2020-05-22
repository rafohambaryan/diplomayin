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

    public function get(Request $request, $sub_id)
    {
        return response()->json($this->interfaces->get($request->all(), $sub_id));
    }

    public function delete(Request $request, $id)
    {
        if (!$request->has('present_id') || !$request->has('main_slide_id')) {
            return response()->json(['success' => false]);
        }
        return response()->json(['success' => true, 'message' => $this->interfaces->delete($request->input('present_id'), $request->input('main_slide_id'), $id)]);
    }

    public function updated(Request $request, $id)
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
        return response()->json(['success' => true, 'data' => $this->interfaces->update($data, $img, $id)], 200);
    }
}
