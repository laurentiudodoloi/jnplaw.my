<?php

namespace App\Eloquent;

class AboutUsSection extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'image_url',
        'has_subsections',
        'has_image',
        'has_image_slider',
        'has_text_boxes',
    ];

    protected $casts = [
        'has_image' => 'boolean',
        'has_subsections' => 'boolean',
        'has_image_slider' => 'boolean',
        'has_text_boxes' => 'boolean',
    ];

    public function subsections()
    {
        return $this->hasMany(AboutUsSubSection::class, 'section_id');
    }

    public function images()
    {
        return $this->hasMany(AboutUsSectionImage::class, 'section_id');
    }

    public function textBoxes()
    {
        return $this->hasMany(AboutUsSectionTextBox::class, 'section_id');
    }
}
