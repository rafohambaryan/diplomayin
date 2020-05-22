<?php


namespace App\Repository\Backend;


use App\Repository\Backend\Interfaces\MainSlideRepositoryInterface;
use App\Services\Backend\MainSlideService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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
            $path = Str::random(10) . time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('/uploads/logo/'), $path);
            File::delete(public_path('uploads/logo/' . $present->logo));
            $present->logo = $path;
            $present->save();
            unset($data['logo']);
        }
        if ($request->has('present_logo')) {
            $present_logo = $request->file('present_logo');
            $path_present = Str::random(10) . time() . '.' . $present_logo->getClientOriginalExtension();
            $present_logo->move(public_path('/uploads/present_logo/'), $path_present);
            File::delete(public_path('uploads/present_logo/' . $present->present_logo));
            $present->present_logo = $path_present;
            $present->save();
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
