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
            'show_add_comment_form' => isset($header['show_add_comment_form']) ? $header['show_add_comment_form'] : false,
            'title' => isset($header['title']) ? $header['title'] : '',
            'subtitle' => isset($header['subtitle']) ? $header['subtitle'] : '',
            'description' => isset($header['description']) ? $header['description'] : '',
            'image_url' => isset($header['image_url']) ? $header['image_url'] : '',
        ]);

        if (!$setting) {
            return response()->json(false, 500);
        }

        if ($header['image'] && isset($header['image_url']) && $header['image_url'] !== '') {
            $this->uploadImage($header['image'], $header['image_url']);
        }

        foreach ($sections as $section) {
            $tempSection = AboutUsSection::query()->create([
                'title' => isset($section['title']) ? $section['title'] : '',
                'subtitle' => isset($section['subtitle']) ? $section['subtitle'] : '',
                'description' => isset($section['description']) ? $section['description'] : '',
                'image_url' => isset($section['image_url']) ? $section['image_url'] : '',
                'has_subsections' => isset($section['has_subsections']) ? $section['has_subsections'] : false,
                'has_image' => isset($section['has_image']) ? $section['has_image'] : false,
                'has_image_slider' => isset($section['has_image_slider']) ? $section['has_image_slider'] : false,
                'has_text_boxes' => isset($section['has_text_boxes']) ? $section['has_text_boxes'] : false,
            ]);

            if (!$tempSection) {
                return response()->json(false, 500);
            }

            if ($section['has_image'] &&
                isset($section['image']) && $section['image'] && $section['image_url'] &&
                strpos($section['image'], 'http') === false
            ) {
                $this->uploadImage($section['image'], $section['image_url']);
            }

            if ($section['has_subsections']) {
                foreach ($section['subsections'] as $subsection) {
                    AboutUsSubSection::query()->create([
                        'section_id' => $tempSection->id,
                        'title' => isset($subsection['title']) ? $subsection['title'] : '',
                        'content' => isset($subsection['content']) ? $subsection['content'] : '',
                    ]);
                }
            }

            if ($section['has_image_slider'] && isset($section['images'])) {
                // $section['slider_images']
                foreach ($section['images'] as $index => $sliderImage) {
                    if (!$sliderImage) {
                        continue;
                    }

                    $url = 'a-p-slide-'.$index.'.png';

                    AboutUsSectionImage::query()->create([
                        'section_id' => $tempSection->id,
                        'image_url' => isset($url) ? $url : '',
                    ]);

                    $this->uploadImage($sliderImage, $url);
                }
            }

            if ($section['has_text_boxes']) {
                foreach ($section['text_boxes'] as $textBox) {
                    AboutUsSectionTextBox::query()->create([
                        'section_id' => $tempSection->id,
                        'header_text' => isset($textBox['header_text']) ? $textBox['header_text'] : '',
                        'title' => isset($textBox['title']) ? $textBox['title'] : '',
                        'content' => isset($textBox['content']) ? $textBox['content'] : '',
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
