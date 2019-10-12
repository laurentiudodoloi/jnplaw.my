<?php

namespace App\Eloquent;

class LandingPageSlide extends Model
{
    protected $fillable = [
        'title',
        'header_title',
        'description',
        'resource_url',
        'resource_type'
    ];
}
