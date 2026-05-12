<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Hero;
use App\Models\About;
use App\Models\Category;
use App\Models\Team;
use App\Models\WhyChooseUs;
use App\Models\Certificate;
use App\Models\QualityGallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

class AdminAboutUsController extends Controller
{
    public function aboutPage()
    {
        $hero = $this->safeFirst(new Hero());


        return view('Frontend.Pages.AboutUs', compact(
            'hero',
        ));
    }

    protected function safeFirst($model)
    {
        if (!Schema::hasTable($model->getTable())) {
            return null;
        }

        return $model::query()->first();
    }

    protected function safeLatest($model)
    {
        if (!Schema::hasTable($model->getTable())) {
            return collect();
        }

        return $model::query()->latest()->get();
    }

    /**
     * Show CMS page
     */
    public function aboutCms()
    {
        $hero = Hero::find(2);


        return view('Admin.about_cms', compact(
            'hero'

        ));
    }


    public function updateHero(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'video_url'   => 'nullable|string',
        ]);

        // Add 'order' => 1 (or any default) to the data array
        $data = $request->only(['title', 'subtitle', 'description', 'video_url']);
        $data['order'] = 2;

        Hero::updateOrCreate(['id' => 2], $data);

        return redirect()->back()->with('success', 'Hero updated successfully');
    }
}
