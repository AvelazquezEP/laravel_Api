<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_name',
    ];

    protected $hidden = [];

    public function items()
    {
        // return $this->hasMany('app\Models\Item');
    }
}
