<?php

namespace App\Eloquent;

class AboutUsSetting extends Model
{
    protected $fillable = [
        'show_add_comment_form',
        'title',
        'subtitle',
        'description',
        'image_url',
    ];
}
