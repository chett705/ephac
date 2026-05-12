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

class AdminController extends Controller
{
    public function homePage()
    {
        $hero = $this->safeFirst(new Hero());
        $about = $this->safeFirst(new About());
        $categories = $this->safeLatest(new Category());
        $teams = $this->safeLatest(new Team());
      
        $certificates = $this->safeLatest(new Certificate());
        
        return view('Frontend.Pages.Home', compact(
            'hero',
            'about',
            'categories',
            'teams',
           
            'certificates',
            
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
    public function homeCms()
    {
        $hero              = Hero::first();
        $about             = About::first();
        $categories        = Category::all();
        $teams             = Team::latest()->get();
       
        $certificates      = Certificate::all();
        
        return view('Admin.home_cms', compact(
            'hero',
            'about',
            'categories',
            'teams',
            
            'certificates',
            
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
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'required|image|mimes:jpeg,png,webp|max:9048',
        ]);

        $file = $request->file('image');
        $filename = time() . '_' . Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/categories'), $filename);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $filename,
        ]);

        return redirect()->route('admin.home.cms')->with('success', 'Category added successfully!');
    }

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

    public function destroyCategory(Category $category)
    {
        if ($category->image && file_exists(public_path('uploads/categories/' . $category->image))) {
            unlink(public_path('uploads/categories/' . $category->image));
        }

        $category->delete();

        return redirect()->route('admin.home.cms')->with('success', 'Category deleted successfully!');
    }

    // ====================== TEAM ======================
    public function storeTeam(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'image'    => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['name', 'position']);
        $data['image'] = $request->file('image')->store('leaders', 'public');

        Team::create($data);

        return redirect()->route('admin.home.cms')->with('success', 'Leader added successfully');
    }

    public function updateTeam(Request $request, Team $team)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['name', 'position']);

        if ($request->hasFile('image')) {
            if ($team->image) {
                Storage::disk('public')->delete($team->image);
            }

            $data['image'] = $request->file('image')->store('leaders', 'public');
        }

        $team->update($data);

        return redirect()->route('admin.home.cms')->with('success', 'Leader updated successfully');
    }

    public function destroyTeam(Team $team)
    {
        if ($team->image) {
            Storage::disk('public')->delete($team->image);
        }

        $team->delete();

        return redirect()->route('admin.home.cms')->with('success', 'Leader deleted successfully');
    }

    // ====================== CERTIFICATES ======================
    public function storeCertificate(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $data = $request->only(['title']);
        $data['image'] = $request->file('image')->store('certificates', 'public');

        Certificate::create($data);

        return redirect()->route('admin.home.cms')->with('success', 'Certificate added successfully');
    }

    public function updateCertificate(Request $request, Certificate $certificate)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $data = $request->only(['title']);

        if ($request->hasFile('image')) {
            if ($certificate->image) {
                Storage::disk('public')->delete($certificate->image);
            }

            $data['image'] = $request->file('image')->store('certificates', 'public');
        }

        $certificate->update($data);

        return redirect()->route('admin.home.cms')->with('success', 'Certificate updated successfully');
    }

    public function destroyCertificate(Certificate $certificate)
    {
        if ($certificate->image) {
            Storage::disk('public')->delete($certificate->image);
        }

        $certificate->delete();

        return redirect()->route('admin.home.cms')->with('success', 'Certificate deleted successfully');
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

    public function updateGallery(Request $request, QualityGallery $qualityGallery)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($qualityGallery->image) {
            Storage::disk('public')->delete($qualityGallery->image);
        }

        $qualityGallery->update([
            'image' => $request->file('image')->store('gallery', 'public'),
        ]);

        return redirect()->route('admin.home.cms')->with('success', 'Quality image updated successfully');
    }
}
