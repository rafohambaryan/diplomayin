<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubheadingMany extends Model
{
    protected $fillable = [
        'present_id', 'main_slide_id', 'text_header', 'background', 'subheading_id'
    ];

    public function content()
    {
        return $this->hasOne(ContentSubheadingMany::class, 'subheading_many_id', 'id');
    }
}
