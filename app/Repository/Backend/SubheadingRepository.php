<?php


namespace App\Repository\Backend;


use App\Helpers\UniqueHash;
use App\Repository\Backend\Interfaces\SubheadingRepositoryInterface;
use App\Services\Backend\ContentSubheadingService;
use App\Services\Backend\OrderService;
use App\Services\Backend\SubheadingServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SubheadingRepository implements SubheadingRepositoryInterface
{
    protected $services;
    protected $content;

    public function __construct(SubheadingServices $services, ContentSubheadingService $content)
    {
        $this->services = $services;
        $this->content = $content;
    }

    public function get($sub_id)
    {
        $content = [];
        $subheading = $this->services->get($sub_id);
        if ($subheading->order->user_id === Auth::id()) {
            $content['text_header'] = $subheading->text_header;
            $content['color'] = $subheading->color;
            $content['background'] = $subheading->background;
            $content['content'] = [];
            $content['success'] = true;
            if ($subheading->content) {
                $content['img'] = $subheading->content->img;
//                $content['img'] = 'oGyve1589964242.png';
                if ($subheading->content->content) {
                    foreach (json_decode($subheading->content->content) as $item) {
                        array_push($content['content'], $item);
                    }
                }
            }
            return $content;
        }
        $content['success'] = false;
        return $content;
    }

    public function delete($sub_id)
    {
        $subheading = $this->services->get($sub_id);
        if ($subheading->order->user_id === Auth::id()) {
            if ($subheading->content && $subheading->content->img) {
                if (file_exists(public_path('/uploads/img/' . $subheading->content->img)))
                    File::delete(public_path('/uploads/img/' . $subheading->content->img));
            }
            if (!empty(current($subheading->many))) {
                foreach ($subheading->many as $many) {
                    if ($many->content && $many->content->img) {
                        if (file_exists(public_path('/uploads/img/' . $many->content->img)))
                            File::delete(public_path('/uploads/img/' . $many->content->img));
                    }
                }
            }
            $subheading->delete();
            return true;
        }
        return false;
    }

    public function createUpdate($data, $img)
    {
        $subheading = $this->services->getUpdateCreate($data['sub_id'], $data['main_slide_id']);
        if ($subheading->exists) {
            $subheading->text_header = $data['text_header'];
            $subheading->color = $data['color'];
            $subheading->background = $data['background'];
            $subheading->save();
            $subContent = $subheading->content;

            if ($img === 'deleted' && $subContent->img) {
                if (file_exists(public_path('/uploads/img/' . $subContent->img))) {
                    File::delete(public_path('/uploads/img/' . $subContent->img));
                }
                $subContent->img = null;
            } else if ($img !== null && $img !== 'deleted') {
                if ($subContent->img) {
                    if (file_exists(public_path('/uploads/img/' . $subContent->img))) {
                        File::delete(public_path('/uploads/img/' . $subContent->img));
                    }
                }
                $path = Str::random(10) . time() . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('/uploads/img/'), $path);
                $subContent->img = $path;
            }
            if ($data['content'] == 'null') {
                $subContent->content = null;
            } else {
                $subContent->content = json_encode($data['content']);
            }

            $subContent->save();
        } else {
            $present_id = $data['present_id'];
            $main_slide_id = $data['main_slide_id'];

            $subheading->present_id = $present_id;
            $subheading->main_slide_id = $main_slide_id;
            $subheading->section_id = UniqueHash::hash($this->services, 'section_id', '33');
            $subheading->text_header = $data['text_header'];
            $subheading->color = $data['color'];
            $subheading->background = $data['background'];
            $subheading->save();
            $contentData = [];
            if ($data['content'] == 'null') {
                $contentData['content'] = null;
            } else {
                $contentData['content'] = json_encode($data['content']);
            }
            $imgPath = null;
            if ($img !== null && $img !== 'deleted') {
                $imgPath = Str::random(10) . time() . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('/uploads/img/'), $imgPath);
                $contentData['path'] = $imgPath;
            } else {
                $contentData['path'] = $imgPath;
            }

            $this->content->createContent($subheading->id, $present_id, $contentData);
            $order = new OrderService();
            $order->createOrder($subheading->id, $present_id);

        }
        return $data;
    }
}
