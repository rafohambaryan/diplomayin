<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TextSlider extends Model
{
    protected $fillable = [
        'user_id', 'present_id', 'main_slide_id', 'background', 'text_header', 'text_content'
    ];
}
