<?php

namespace App\Http\Controllers\Backend;


use App\Models\Colors;
use App\Repository\Backend\Interfaces\OrderRepositoryInterface;
use App\Repository\Backend\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    protected $repository;

    public function __construct(PostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return view('pages.index', ['presents' => $this->repository->all(3)]);
    }

    public function delete(Request $request)
    {
        $presents_id = $request->input('presents');
        if (is_array($presents_id)) {
            return response()->json(['success' => true, 'messages' => $this->repository->delete($presents_id)]);
        }
        return response()->json(['success' => false, 'messages' => ['not selected presents']]);
    }

    public function create(Request $request, $id = null)
    {
        $this->repository->create($request->all(), $id);
        if ($request->method() === 'PUT') {
            return response()->json(['success' => true, 'messages' => ['save']], 201);
        }
        return redirect()->back();
    }

    public function get($id, OrderRepositoryInterface $order)
    {
        $present = $this->repository->get($id);
        $orders = $order->get($id, 'ASC');
        if ($present)
            return view('pages.present', ['present' => $present, 'colors' => Colors::all(), 'orders' => $orders]);
        return redirect()->to('/');
    }
}
