<?php


namespace App\Services\Backend;


use App\Models\Subheading;

class SubheadingServices extends Subheading
{
    protected $table = 'subheadings';

    public function get($sub_id)
    {
        return $this->find($sub_id);
    }

    public function getUpdateCreate($sub_id, $main_slide_id)
    {
        return $this->firstOrNew(['id' => $sub_id, 'main_slide_id' => $main_slide_id]);
    }
}
