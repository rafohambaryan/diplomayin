<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentType extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'type'
    ];
}
