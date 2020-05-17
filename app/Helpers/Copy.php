<?php


namespace App\Helpers;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Copy extends File
{
    public static function file($go, $to, $ext = 'png')
    {
        $path = Str::random(5) . time() . '.' . $ext;
        self::copy(public_path($go), public_path($to . $path));
        return $path;
    }
}
