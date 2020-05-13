<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentSubheading extends Model
{
    protected $fillable = [
        'content', 'img', 'subheading_id', 'content_type_id', 'present_id'
    ];

    public function contentType()
    {
        return $this->belongsTo(ContentType::class,'content_type_id','id');
    }
}
