<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'present_id', 'subheading_id', 'user_id', 'order'
    ];

    public function presentOne()
    {
        return $this->hasOne(Present::class, 'present_id', 'id');
    }

    public function subheadings()
    {
        return $this->belongsTo(Subheading::class, 'subheading_id', 'id');
    }
}
