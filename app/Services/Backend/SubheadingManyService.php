<?php


namespace App\Services\Backend;


use App\Models\SubheadingMany;

class SubheadingManyService extends SubheadingMany
{
    protected $table = 'subheading_manies';

    public function get($present, $sub_id)
    {
        return $this->where('present_id', $present->id)->where('subheading_id', $sub_id)->get();
    }

    public function create()
    {

    }
}
