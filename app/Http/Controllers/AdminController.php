<?php

namespace App\Http\Controllers;

use App\Eloquent\AboutUsSection;
use App\Eloquent\AboutUsSectionImage;
use App\Eloquent\AboutUsSectionTextBox;
use App\Eloquent\AboutUsSetting;
use App\Eloquent\AboutUsSubSection;
use App\Eloquent\Project;
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
            'projects' => Project::all(),
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
            'show_add_comment_form' => isset($header['show_add_comment_form']),
        ]);

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
                    'has_image' => $hasImage,
                    'has_subsections' => $hasSubsections,
                    'has_image_slider' => $hasImageSlider,
                    'has_text_boxes' => $hasTextBoxes,
                ]);

                if (!$savedSection) {
                    $errors['sections'][$index][] = 'Section could not be saved.';
                    continue;
                }

                AboutUsSubSection::query()->delete();

                if ($hasSubsections && isset($section['subsections'])) {
                    foreach ($section['subsections'] as $subsection) {
                        AboutUsSubSection::query()->create([
                            'section_id' => $savedSection->id,
                            'title' => isset($subsection['title']) ? $subsection['title'] : '',
                            'content' => isset($subsection['content']) ? $subsection['content'] : '',
                        ]);
                    }
                }

                AboutUsSectionTextBox::query()->delete();

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
                        AboutUsSectionImage::query()->delete();

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
