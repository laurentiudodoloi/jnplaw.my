<?php

namespace App\Eloquent;

class Project extends Model
{
    protected $fillable = [
        'title',
        'header_title',
        'description',
        'resource_url',
        'resource_type'
    ];
}
