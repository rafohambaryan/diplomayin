<?php


namespace App\Services\Backend;


use App\Models\MainSlide;
use App\Models\Present;

class MainSlideService extends MainSlide
{
    protected $table = 'main_slides';

    public function updateMainSlide($data, $present)
    {
        foreach ($data as $index => $datum) {
            $present[$index] = $datum;
        }
        return $present->save();
    }

    public function get($present_id)
    {
        return Present::find($present_id)->mainSlide;
    }
}
