<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentSubheadingMany extends Model
{
  protected $fillable = [
    'content','img','subheading_many_id','content_type','present_id'
  ];
}
