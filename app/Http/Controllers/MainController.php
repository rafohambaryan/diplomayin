<?php

namespace App\Http\Controllers;

use App\Models\Colors;
use App\Models\MainSlide;
use App\Models\Present;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $presents = Present::where('user_id', Auth::id())->orderBy('id', 'DESC')->paginate(3);
        return view('pages.index', ['presents' => $presents]);
    }

    public function createPresent(Request $request, $id = null)
    {
        if (Auth::check()) {
            $present = Present::firstOrNew(['id' => $id]);
            $present->name = $request->input('name');
            if ($present) {
                $present->user_id = Auth::id();
                do {
                    $url = Str::random(32);
                    $present->url = $url;
                } while (Present::where("url", "=", $url)->first() instanceof Present);
                $present->save();
                $last_id = $present->id;
                $logo_path = Str::random(5) . time() . '.png';
                $present_logo_path = Str::random(5) . '1' . time() . '.png';
                File::copy(public_path('/images/logo.png'), public_path('/uploads/logo/' . $logo_path));
                File::copy(public_path('/images/mysql-logo.png'), public_path('/uploads/present_logo/' . $present_logo_path));
                $main_Slides = MainSlide::create([
                    'user_id' => Auth::id(),
                    'present_id' => $last_id,
                    'logo' => $logo_path,
                    'logo_url' => 'http://npuagb.am/hy/',
                    'present_logo' => $present_logo_path,
                    'main_name' => 'Դիպլոմային աշխատանք',
                    'topic' => '<< Տվյալների բազայի նախագծում և ծրագրավորում օգտագործելով MySQL >>',
                    'student' => 'Ռաֆայել Համբարյան',
                    'head' => 'Արտակ Չախոյան',
                    'background' => '#00BFFF'
                ]);
            } else {
                $present->save();
            }
        }
        return redirect()->back();

    }
}
