<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Present extends Model
{
    protected $fillable = [
        'name', 'url', 'user_id'
    ];

    public function mainSlide()
    {
        return $this->hasOne(MainSlide::class,'present_id','id');
    }
}
