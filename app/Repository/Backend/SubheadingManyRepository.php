<?php


namespace App\Repository\Backend;

use App\Repository\Backend\Interfaces\SubheadingManyRepositoryInterface;
use App\Services\Backend\ContentSubheadingManyService;
use App\Services\Backend\SubheadingManyService;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SubheadingManyRepository implements SubheadingManyRepositoryInterface
{
    protected $services;
    protected $content;
    private $return;

    public function __construct(SubheadingManyService $services, ContentSubheadingManyService $content)
    {
        $this->services = $services;
        $this->content = $content;
    }

    public function get($data, $sub_id)
    {
        $many = $this->services->get($data['present_id'], $sub_id, $data['main_slide_id']);
        if (!empty(current($many))) {
            $this->return['success'] = true;
            $this->return['data'] = [];
            foreach ($many as $i => $item) {
                if (isset($data['find'])) {
                    if ($data['find'] == $item->id) {
                        $this->return['data'] = $item;
                        $this->return['data']['content'] = $item->content;
                        break 1;
                    } else {
                        continue 1;
                    }
                } else {
                    array_push($this->return['data'], $item);
                    $this->return['data'][$i]['content'] = $item->content;
                }
            }
            if (isset($data['find']) && empty($this->return['data'])) {
                $this->return['success'] = false;
            }
        } else {
            $this->return['success'] = false;
        }
        return $this->return;
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
        $data['count'] = $this->services->count($data['sub_id']);

        return $data;
    }

    public function delete($present_id, $main_slide_id, $id)
    {
        $sub_many = $this->services->findOne($present_id, $main_slide_id, $id);
        if ($sub_many) {
            if ($sub_many->content->img) {
                if (file_exists(public_path('/uploads/img/' . $sub_many->content->img))) {
                    File::delete(public_path('/uploads/img/' . $sub_many->content->img));
                }
            }
            return $sub_many->delete();
        }
        return 0;
    }
}
