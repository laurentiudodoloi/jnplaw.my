<?php

namespace App\Eloquent;

class Project extends Model
{
    protected $fillable = ['title', 'description', 'resource_url', 'resource_type'];
}
