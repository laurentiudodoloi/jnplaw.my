<?php

namespace App\Http\Controllers;

use App\Eloquent\AboutUsSection;
use App\Eloquent\AboutUsSectionImage;
use App\Eloquent\AboutUsSectionTextBox;
use App\Eloquent\AboutUsSetting;
use App\Eloquent\AboutUsSubSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
      return view('admin.landing-page');
    }

    public function about()
    {
      return view('admin.about');
    }

    public function aboutContent()
    {
        $settings = AboutUsSetting::query()->first();
        $sections = AboutUsSection::query()
            ->with([
                'subsections',
                'images',
                'textBoxes',
            ])
            ->get();

        $content = [
            'settings' => $settings,
            'sections' => $sections,
        ];

        return response()->json($content);
    }

    public function updateAboutContent(Request $request)
    {
        $header = $request->input('settings');
        $sections = $request->input('sections');

        AboutUsSetting::query()->delete();
        AboutUsSection::query()->delete();
        AboutUsSubSection::query()->delete();
        AboutUsSectionImage::query()->delete();
        AboutUsSectionTextBox::query()->delete();

        $setting = AboutUsSetting::query()->create([
            'show_add_comment_form' => $header['show_add_comment_form'],
            'title' => $header['title'],
            'subtitle' => $header['subtitle'],
            'description' => $header['description'],
            'image_url' => $header['image_url'],
        ]);

        if (!$setting) {
            return response()->json(false, 500);
        }

        if ($header['image']) {
            $this->uploadImage($header['image'], $header['image_url']);
        }

        foreach ($sections as $section) {
            $tempSection = AboutUsSection::query()->create([
                'title' => $section['title'],
                'subtitle' => $section['subtitle'],
                'description' => $section['description'],
                'image_url' => $section['image_url'],
                'has_subsections' => $section['has_subsections'],
                'has_image' => $section['has_image'],
                'has_image_slider' => $section['has_image_slider'],
                'has_text_boxes' => $section['has_text_boxes'],
            ]);

            if (!$tempSection) {
                return response()->json(false, 500);
            }

            if ($section['has_image'] && isset($section['image']) && strpos($section['image'], 'http') === false) {
                $this->uploadImage($section['image'], $section['image_url']);
            }

            if ($section['has_subsections']) {
                foreach ($section['subsections'] as $subsection) {
                    AboutUsSubSection::query()->create([
                        'section_id' => $tempSection->id,
                        'title' => $subsection['title'],
                        'content' => $subsection['content'],
                    ]);
                }
            }

            if ($section['has_image_slider']) {
                // $section['slider_images']
                foreach ($section['images'] as $index => $sliderImage) {
                    $url = 'a-p-slide-'.$index.'-.png';

                    AboutUsSectionImage::query()->create([
                        'section_id' => $tempSection->id,
                        'image_url' => $url,
                    ]);

                    $this->uploadImage($sliderImage, $url);
                }
            }

            if ($section['has_text_boxes']) {
                foreach ($section['text_boxes'] as $textBox) {
                    AboutUsSectionTextBox::query()->create([
                        'section_id' => $tempSection->id,
                        'header_text' => $textBox['header_text'],
                        'title' => $textBox['title'],
                        'content' => $textBox['content'],
                    ]);
                }
            }
        }

        return response()->json(true);
    }

    public function uploadImage($uploadImage, $name)
    {
        $image = $uploadImage;

        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace('data:image/jpg;base64,', '', $image);
        $image = str_replace('data:image/png;base64,', '', $image);

        $image = str_replace(' ', '+', $image);

        $imageName = $name;

        Storage::disk('uploads')->put($imageName, base64_decode($image));
    }
}
