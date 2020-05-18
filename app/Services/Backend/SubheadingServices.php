<?php


namespace App\Services\Backend;


use App\Models\Subheading;

class SubheadingServices extends Subheading
{
    protected $table = 'subheadings';

    public function get($present, $sub_id)
    {
        return $this->where('present_id', $present->id)->get();
    }
}
