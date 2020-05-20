<?php


namespace App\Services\Backend;


use App\Helpers\UniqueHash;
use App\Models\SubheadingMany;

class SubheadingManyService extends SubheadingMany
{
    protected $table = 'subheading_manies';

    public function get($present, $sub_id)
    {
        return $this->where('present_id', $present->id)->where('subheading_id', $sub_id)->get();
    }

    public function getCreate($data)
    {
        return $this->create([
            'present_id' => $data['present_id'],
            'main_slide_id' => $data['main_slide_id'],
            'subheading_id' => $data['sub_id'],
            'text_header' => $data['text_header'],
            'color' => $data['color'],
            'background' => $data['background'],
            'section_id' => UniqueHash::hash($this, 'section_id', 30)
        ]);
    }
}
