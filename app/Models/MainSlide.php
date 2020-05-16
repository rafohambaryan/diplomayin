<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainSlide extends Model
{
    protected $fillable = [
        'user_id', 'present_id', 'logo', 'logo_url', 'present_logo', 'main_name', 'topic', 'student', 'head', 'background'
    ];

    public function present()
    {
        return $this->belongsTo(Present::class, 'present_id', 'id');
    }
}
