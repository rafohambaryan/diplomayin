<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'ip_front', 'ip_back', 'content', 'id'
    ];
}
