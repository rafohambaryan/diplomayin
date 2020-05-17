<?php


namespace App\Services\Backend;


use App\Helpers\Copy;
use App\Helpers\UniqueHash;
use App\Models\MainSlide;
use App\Models\Present;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostService extends Present
{
    protected $table = 'presents';

    public function getFind($present_id)
    {
        return $this->where('id', $present_id)->where('user_id', Auth::id())->first();
    }

    public function getAll($paginate = 5)
    {
        return $this->where('user_id', Auth::id())->orderBy('id', 'DESC')->paginate($paginate);
    }

    public function deletePresent($present_id)
    {
        $present = $this->where('id', $present_id)->where('user_id', Auth::id())->first();
        foreach ($present->contentOne as $item) {
            if ($item->img) {
                if (file_exists(public_path('/uploads/img/' . $item->img)))
                    File::delete(public_path('/uploads/img/' . $item->img));
            }
        }
        foreach ($present->contentTwo as $itemTwo) {
            if ($itemTwo->img) {
                if (file_exists(public_path('/uploads/img/' . $itemTwo->img)))
                    File::delete(public_path('/uploads/img/' . $itemTwo->img));
            }
        }
        if ($present->mainSlide and file_exists(public_path('/uploads/logo/' . $present->mainSlide->logo))) {
            File::delete(public_path('/uploads/logo/' . $present->mainSlide->logo));
        }
        if ($present->mainSlide and file_exists(public_path('/uploads/present_logo/' . $present->mainSlide->present_logo))) {
            File::delete(public_path('/uploads/present_logo/' . $present->mainSlide->present_logo));
        }

        return $present->delete();
    }

    public function create($name, $id)
    {
        $present = $this->firstOrNew(['id' => $id, 'user_id' => Auth::id()]);
        $present->name = $name;
        if (!$present->exists) {
            $present->user_id = Auth::id();
            $present->url = UniqueHash::hash($this, 'url', 33);
            $present->save();
            $present_id = $present->id;
            MainSlide::create([
                'user_id' => Auth::id(),
                'present_id' => $present_id,
                'logo' => Copy::file('/images/logo.png', '/uploads/logo/'),
                'logo_url' => 'http://npuagb.am/hy/',
                'present_logo' => Copy::file('/images/mysql-logo.png', '/uploads/present_logo/'),
                'main_name' => '--------',
                'topic' => '----------',
                'student' => '------',
                'head' => '---------',
                'background' => '#8A2BE2'
            ]);
            return $present_id;
        }
        return $present->save();
    }


}
