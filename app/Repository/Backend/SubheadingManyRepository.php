<?php


namespace App\Repository\Backend;

use App\Repository\Backend\Interfaces\SubheadingManyRepositoryInterface;
use App\Services\Backend\ContentSubheadingManyService;
use App\Services\Backend\SubheadingManyService;
use Illuminate\Support\Str;

class SubheadingManyRepository implements SubheadingManyRepositoryInterface
{
    protected $services;
    protected $content;

    public function __construct(SubheadingManyService $services, ContentSubheadingManyService $content)
    {
        $this->services = $services;
        $this->content = $content;
    }

    public function get($present_id, $sub_id)
    {
        return [];
    }

    public function createSubMany($data, $img)
    {
        $subheadingMany = $this->services->getCreate($data);
        $dataContent = array();
        if ($data['content'] == 'null') {
            $dataContent['content'] = null;
        } else {
            $dataContent['content'] = json_encode($data['content']);
        }
        $imgPath = null;
        if ($img != null && $img !== 'deleted') {
            $imgPath = Str::random(10) . time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('/uploads/img/'), $imgPath);
            $dataContent['path'] = $imgPath;
        } else {
            $dataContent['path'] = $imgPath;
        }
        $this->content->createContent($subheadingMany->id, $data['present_id'], $dataContent);

        return $data;
    }
}
