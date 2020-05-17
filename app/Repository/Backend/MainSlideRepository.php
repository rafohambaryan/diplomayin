<?php


namespace App\Repository\Backend;


use App\Repository\Backend\Interfaces\MainSlideRepositoryInterface;
use App\Services\Backend\MainSlideService;
use Illuminate\Support\Facades\File;

class MainSlideRepository implements MainSlideRepositoryInterface
{
    protected $service;
    private $logo;
    private $present_logo;

    public function __construct(MainSlideService $service)
    {
        $this->service = $service;
    }

    public function update($request)
    {
        $data = $request->all();
        $present_id = $data['present_id'];
        unset($data['present_id']);
        $present = $this->get($present_id);
        if (!$present) {
            return ['success' => false, 'messages' => 'present not fount'];
        }
        if ($request->has('logo')) {
            $logo = $request->file('logo');
            File::delete(public_path('uploads/logo/' . $present->present_logo));
            $logo->move(public_path('/uploads/logo/'), $present->logo);
            unset($data['logo']);
        }
        if ($request->has('present_logo')) {
            $present_logo = $request->file('present_logo');
            File::delete(public_path('uploads/present_logo/' . $present->present_logo));
            $present_logo->move(public_path('/uploads/present_logo/'), $present->present_logo);
            unset($data['present_logo']);
        }
        $this->service->updateMainSlide($data, $present);
        return ['success' => true, 'messages' => 'updated'];
    }

    public function get($present_id)
    {
        return $this->service->get($present_id);
    }
}
