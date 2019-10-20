<?php

namespace App\Http\Controllers\Admin;

use App\Eloquent\AboutUsSection;
use App\Eloquent\AboutUsSectionImage;
use App\Eloquent\AboutUsSectionTextBox;
use App\Eloquent\AboutUsSetting;
use App\Eloquent\AboutUsSubSection;
use App\Http\Controllers\Controller;
use App\Util\FileUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{
    public function storeSettings(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:191',
            'subtitle' => 'required|string|max:191',
            'description' => 'required|string|max:255',
        ]);

        $showForm = $request->input('show_add_comment_form');

        $storeFileName = '';
        $uploaded = FileUploader::store($request->file('header_image'));

        if ($uploaded) {
            $storeFileName = $uploaded['name'];
        }

        $settings = AboutUsSetting::query()->first();
        if ($settings) {
            Storage::disk('uploads')->delete($settings->image_url);
        }

        AboutUsSetting::query()->delete();

        AboutUsSetting::query()
            ->create([
                'title' => $request->input('title'),
                'subtitle' => $request->input('subtitle'),
                'description' => $request->input('description'),
                'image_url' => $storeFileName,
                'show_add_comment_form' => isset($showForm),
            ]);

        return redirect()->back();
    }

    public function storeSections(Request $request)
    {
        $sections = $request->input('sections');
        $files = $request->file('sections');

        if (!count($sections)) {
            AboutUsSection::query()->delete();
            AboutUsSubSection::query()->delete();
            AboutUsSectionImage::query()->delete();
            AboutUsSectionTextBox::query()->delete();

            return redirect()->back();
        }

        foreach ($sections as $index => $section) {
            $storeFileName = '';

            if (isset($section['id']) && intval($section['id']) !== 0) {
                $saveSection = AboutUsSection::query()->find(intval($section['id']));

                if (isset($saveSection)) {
                    if (isset($files, $files[$index], $files[$index]['image'])
                        && $files[$index]['image'] !== $saveSection->image_url
                        && $saveSection->image_url !== '') {
                        Storage::disk('uploads')->delete($saveSection->image_url);
                    } else {
                        $storeFileName = $saveSection->image_url;
                    }
                }
            }

            if (isset($section['remove_image'], $saveSection)) {
                Storage::disk('uploads')->delete($saveSection->image_url);
                $storeFileName = '';
            } else {
                $uploaded = isset($files[$index], $files[$index]['image'])
                    ? FileUploader::store($files[$index]['image'])
                    : false;

                if ($uploaded) {
                    $storeFileName = $uploaded['name'];
                }
            }

            $newSection = AboutUsSection::query()
                ->updateOrCreate([
                   'id' =>  intval($section['id'])
                ],
                [
                    'title' => $section['title'],
                    'subtitle' => $section['subtitle'],
                    'description' => $section['description'],
                    'image_url' => $storeFileName,
                ]);

            if (!$newSection) {
                continue;
            }

            $sectionId = $newSection->id;

            AboutUsSubSection::query()
                ->where('section_id', $sectionId)
                ->delete();
            if (isset($section['subsections'])) {
                foreach ($section['subsections'] as $subsection) {
                    AboutUsSubSection::query()
                        ->create([
                            'section_id' => $sectionId,
                            'title' => $subsection['title'],
                            'content' => $subsection['description'],
                        ]);
                }
            }

            AboutUsSectionTextBox::query()
                ->where('section_id', $sectionId)
                ->delete();
            if (isset($section['boxes'])) {
                foreach ($section['boxes'] as $subsection) {
                    AboutUsSectionTextBox::query()
                        ->create([
                            'section_id' => $sectionId,
                            'header_text' => $subsection['header_text'],
                            'title' => $subsection['title'],
                            'content' => $subsection['content'],
                        ]);
                }
            }

            if (isset($section['delete_slider_images'])) {
                $images = AboutUsSectionImage::query()
                    ->where('section_id', $sectionId)
                    ->get();

                foreach ($images as $image) {
                    Storage::disk('uploads')->delete($image->image_url);
                    $image->delete();
                }

            } elseif (isset($files[$index], $files[$index]['slider_images'])) {
                AboutUsSectionImage::query()
                    ->where('section_id', $sectionId)
                    ->delete();

                foreach ($files[$index]['slider_images'] as $sliderImage) {
                    $uploaded = FileUploader::store($sliderImage);

                    $storeName = '';
                    if ($uploaded) {
                        $storeName = $uploaded['name'];
                    }

                    AboutUsSectionImage::query()
                        ->create([
                            'section_id' => $sectionId,
                            'image_url' => $storeName,
                        ]);
                }
            }
        }

        return redirect()->back();
    }
}
