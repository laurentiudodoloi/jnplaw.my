<?php

namespace App\Eloquent;

class AboutUsSection extends Model
{
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
