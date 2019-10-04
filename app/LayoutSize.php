<?php

namespace App;

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
