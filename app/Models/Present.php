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
        return $this->hasOne(MainSlide::class, 'present_id', 'id');
    }

    public function contentOne()
    {
        return $this->hasMany(ContentSubheading::class, 'present_id', 'id');
    }

    public function contentTwo()
    {
        return $this->hasMany(ContentSubheadingMany::class, 'present_id', 'id');
    }
}
