<?php

namespace App\Http\Controllers;

use App\Eloquent\AboutUsSection;
use App\Eloquent\AboutUsSectionImage;
use App\Eloquent\AboutUsSectionTextBox;
use App\Eloquent\AboutUsSetting;
use App\Eloquent\AboutUsSubSection;
use App\Eloquent\LandingPageSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $settings = AboutUsSetting::query()->first();
        $sections = AboutUsSection::query()
            ->with([
                'subsections',
                'images',
                'textBoxes',
            ])
            ->get();

        $aboutPageContent = [
            'settings' => $settings,
            'sections' => $sections,
        ];

        $data = [
            'slides' => LandingPageSlide::all(),
            'about' => $aboutPageContent,
        ];

        return view('admin.landing-page', compact('data'));
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
        $errors = [
            'image' => [],
            'sections' => [],
        ];

        $header = $request->input('header');
        $sections = $request->input('sections');

        $resource = $request->file('image');

        $upload = $this->uploadResource($resource);

        if ($upload['success']) {
            $header['image_url'] = 'uploads/'.$resource->getClientOriginalName();
        } else {
            $header['image_url'] = null;
            $errors['image'] = $upload['errors'];
        }

        $settings = AboutUsSetting::query()->first();

        AboutUsSetting::query()->delete();

        $setting = AboutUsSetting::query()->create([
            'title' => isset($header['title']) ? $header['title'] : $settings->title ?? '',
            'subtitle' => isset($header['subtitle']) ? $header['subtitle'] : $settings->subtitle ?? '',
            'description' => isset($header['description']) ? $header['description'] : $settings->description ?? '',
            'image_url' => isset($header['image_url']) ? $header['image_url'] : $settings->image_url ?? '',
            'show_add_comment_form' => intval(isset($header['show_add_comment_form'])),
        ]);

        $sectionIds = collect($sections)->map(function ($el) {
          if (isset($el['id'])) {
            return $el['id'];
          }
        })->toArray();

        AboutUsSection::query()
          ->whereNotIn('id', $sectionIds)
          ->delete();

        if ($setting && isset($sections)) {
            $files = $request->file('sections');

            foreach ($sections as $index => $section) {
                $id = isset($section['id']) ? $section['id'] : false;
                $hasImage = isset($section['has_image']);

                if ($hasImage) {
                    $resource = isset($files[$index]['image']) ? $files[$index]['image'] : false;
                    $upload = $this->uploadResource($resource);

                    if ($upload['success']) {
                        $imageUrl = 'uploads/'.$resource->getClientOriginalName();
                    } else {
                        $imageUrl = null;
                        $errors['sections'][$index]['image'] = $upload['errors'];
                    }
                }

                $hasSubsections = isset($section['has_subsections']);
                $hasImageSlider = isset($section['has_image_slider']);
                $hasTextBoxes = isset($section['has_text_boxes']);

                $existingSection = null;
                if ($id) {
                    $existingSection = AboutUsSection::query()->find($id);

                    AboutUsSection::query()->find($id)->delete();
                }

                $savedSection = AboutUsSection::query()->create([
                    'title' => isset($section['title']) ? $section['title'] : '',
                    'subtitle' => isset($section['subtitle']) ? $section['subtitle'] : '',
                    'description' => isset($section['description']) ? $section['description'] : '',
                    'image_url' => isset($imageUrl) ? $imageUrl : $existingSection->image_url ?? '',
                    'has_image' => intval($hasImage),
                    'has_subsections' => intval($hasSubsections),
                    'has_image_slider' => intval($hasImageSlider),
                    'has_text_boxes' => intval($hasTextBoxes),
                ]);

                if (!$savedSection) {
                    $errors['sections'][$index][] = 'Section could not be saved.';
                    continue;
                }

                if ($id) {
                  AboutUsSubSection::query()
                    ->where('section_id', $id)
                    ->delete();
                }

                if ($hasSubsections && isset($section['subsections'])) {
                    foreach ($section['subsections'] as $subsection) {
                        AboutUsSubSection::query()->create([
                            'section_id' => $savedSection->id,
                            'title' => isset($subsection['title']) ? $subsection['title'] : '',
                            'content' => isset($subsection['content']) ? $subsection['content'] : '',
                        ]);
                    }
                }

              if ($id) {
                AboutUsSectionTextBox::query()
                  ->where('section_id', $id)
                  ->delete();
              }

                if ($hasTextBoxes && isset($section['boxes'])) {
                    foreach ($section['boxes'] as $textBox) {
                        AboutUsSectionTextBox::query()->create([
                            'section_id' => $savedSection->id,
                            'header_text' => isset($textBox['header_text']) ? $textBox['header_text'] : '',
                            'title' => isset($textBox['title']) ? $textBox['title'] : '',
                            'content' => isset($textBox['content']) ? $textBox['content'] : '',
                        ]);
                    }
                }

                if ($id) {
                    $sectionImages = AboutUsSectionImage::query()
                        ->where('section_id', $id)
                        ->get();
                }

                if ($hasImageSlider) {
                    $sliderImages = isset($files[$index]['slider_images'])
                        ? $files[$index]['slider_images']
                        : false;

                    if ($sliderImages) {
                      if ($id) {
                        AboutUsSectionImage::query()
                          ->where('section_id', $id)
                          ->delete();
                      }

                        foreach ($sliderImages as $resource) {
                            $upload = $this->uploadResource($resource);

                            if ($upload['success']) {
                                $imageUrl = 'uploads/'.$resource->getClientOriginalName();

                                AboutUsSectionImage::query()->create([
                                    'section_id' => $savedSection->id,
                                    'image_url' => $imageUrl,
                                ]);
                            } else {
                                $imageUrl = null;
                                $errors['sections'][$index]['slider_image'] = 'Not all slider images are saved.';
                            }
                        }
                    } else {
                        foreach ($sectionImages as $image) {
                            AboutUsSectionImage::query()->create([
                                'section_id' => $savedSection->id,
                                'image_url' => $image->image_url,
                            ]);
                        }
                    }
                } elseif ($id) {
                    AboutUsSectionImage::query()->where('section_id', $id)->delete();
                }
            }
        }

        $data = [
            'success' => !count($errors['image']) && !count($errors['sections']),
            'errors' => $errors
        ];

        return redirect()->back()->with('data', $data);
    }

    public function uploadResource($resource)
    {
        $supportImageFormats = ['jpg', 'jpeg', 'png'];
        $supportVideoFormats = ['mp4'];

        $errors = [];

        if (!$resource) {
            $errors[] = 'You have to select a header image.';
        } elseif (!array_search($resource->extension(), array_merge($supportImageFormats, []))) {
            $errors[] = 'Wrong image format.';
        } else {
            if (!Storage::disk('uploads')->put($resource->getClientOriginalName(), $resource->get())) {
                $errors[] = 'Could not upload the image. Maybe the image is too big or it is corrupted.';
            }
        }

        return [
            'success' => !count($errors),
            'errors' => $errors,
        ];
    }

    public function removeImageSliderImage(Request $request)
    {
        AboutUsSectionImage::query()
          ->where('section_id', $request->input('section_id'))
          ->where('image_url', $request->input('image_url'))
          ->delete();
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

/**
 *
 * A Leading Maritime & Commercial Law Firm
 * Niche Firm, Big Difference
 * We are specialists in all aspects of shipping law and are a trusted shipping legal firm used by companies not just in Malaysia but internationally. We provide clear, comprehensive advice on all aspects of shipping law.
 *
 *
 * About Us
 * We deliver solutions to business in fragile settings
 * As an organization that is nationally renowned for our rich experience and success in cases involving maritime and Malaysian admiralty law, we have ensured over the years that our clients got comprehensive and top-notch legal service covering all aspects of the maritime industry.
 *
 */
