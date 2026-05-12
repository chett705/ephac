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

class AdminController extends Controller
{
    /**
     * Show CMS page
     */
    public function homeCms()
    {
        $hero              = Hero::first();
        $about             = About::first();
        $categories        = Category::all();
        $teams             = Team::all();
        $why_choose_us     = WhyChooseUs::all();
        $certificates      = Certificate::all();
        $quality_galleries = QualityGallery::all();

        return view('Admin.home_cms', compact(
            'hero',
            'about',
            'categories',
            'teams',
            'why_choose_us',
            'certificates',
            'quality_galleries'
        ));
    }

    // ====================== HERO ======================
    public function updateHero(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'video_url'   => 'nullable|string',
        ]);

        Hero::updateOrCreate(['id' => 1], $request->only(['title', 'subtitle', 'description', 'video_url']));

        return redirect()->back()->with('success', 'Hero updated successfully');
    }

    // ====================== ABOUT ======================
    public function updateAbout(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        About::updateOrCreate(['id' => 1], $request->only(['title', 'description']));

        return redirect()->back()->with('success', 'About updated successfully');
    }

    // ====================== CATEGORY UPDATE ======================
    public function updateCategory(Request $request, Category $category)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,webp|max:9048',
        ]);

        $data = $request->only(['name', 'description']);

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($category->image && file_exists(public_path('uploads/categories/' . $category->image))) {
                unlink(public_path('uploads/categories/' . $category->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/categories'), $filename);

            $data['image'] = $filename;
        }

        $category->update($data);

        return redirect()->back()->with('success', 'Category updated successfully!');
    }

    // ====================== TEAM ======================
    public function storeTeam(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
        ]);

        Team::create($request->only(['name', 'position']));

        return redirect()->back()->with('success', 'Team member added');
    }

    // ====================== WHY CHOOSE US ======================
    public function storeWhyChoose(Request $request)
    {
        $request->validate([
            'number' => 'nullable|string',
            'title'  => 'required|string',
            'desc'   => 'nullable|string',
        ]);

        WhyChooseUs::create($request->only(['number', 'title', 'desc']));

        return redirect()->back()->with('success', 'Added successfully');
    }

    // ====================== GALLERY ======================
    public function storeGallery(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = $request->file('image')->store('gallery', 'public');

        QualityGallery::create(['image' => $path]);

        return redirect()->back()->with('success', 'Image uploaded');
    }
}
