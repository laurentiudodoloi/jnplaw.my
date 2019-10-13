<?php

namespace App\Eloquent;

class LandingPageSlide extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'resource_url',
        'device',
    ];
}
