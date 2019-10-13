<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class LayoutSize extends Model
{
    protected $fillable = [
        'element',
        'fixed_width',
        'width',
        'height',
        'unit',
    ];
}
