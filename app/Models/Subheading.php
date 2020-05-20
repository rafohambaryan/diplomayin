<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subheading extends Model
{
    protected $fillable = [
        'present_id', 'main_slide_id', 'text_header', 'background'
    ];

    public function content()
    {
        return $this->hasOne(ContentSubheading::class, 'subheading_id', 'id');
    }

    public function many()
    {
        return $this->hasMany(SubheadingMany::class, 'subheading_id', 'id');
    }

    public function order()
    {
        return $this->hasOne(Order::class, 'subheading_id', 'id');
    }
}
