<?php


namespace App\Services\Backend;


use App\Models\ContentSubheadingMany;

class ContentSubheadingManyService extends ContentSubheadingMany
{
    protected $table = 'content_subheading_manies';

    public function createContent($sub_id, $present_id, $data = [])
    {
        $this->content_type_id = 1;
        $this->subheading_many_id = $sub_id;
        $this->present_id = $present_id;
        $this->content = $data['content'];
        $this->img = $data['path'];
        return $this->save();
    }
}
