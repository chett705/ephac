<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityCategory;
use App\Models\ActivityItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    public function frontendIndex()
    {
        $categories = ActivityCategory::with('items')->orderBy('sort_order', 'asc')->get();

        return view('Frontend.Pages.Activities', compact('categories'));
    }

    public function index()
    {
        $categories = ActivityCategory::with('items')->orderBy('sort_order', 'asc')->get();

        return view('Admin.activity', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'sort_order' => 'nullable|integer',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('activities', 'public');
        }

        ActivityCategory::create([
            'title' => $request->title,
            'image' => $imagePath,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->back()->with('success', 'Category added successfully!');
    }

    public function updateCategory(Request $request, $id)
    {
        $category = ActivityCategory::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp',
            'sort_order' => 'nullable|integer',
        ]);

        $imagePath = $category->image;
        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            $imagePath = $request->file('image')->store('activities', 'public');
        }

        $category->update([
            'title' => $request->title,
            'image' => $imagePath,
            'sort_order' => $request->sort_order ?? $category->sort_order ?? 0,
        ]);

        return redirect()->back()->with('success', 'Category updated successfully!');
    }

    public function storeItem(Request $request, $categoryId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'sort_order' => 'nullable|integer',
        ]);

        ActivityItem::create([
            'category_id' => $categoryId,
            'name' => $request->name,
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->back()->with('success', 'Activity item added!');
    }

    public function updateItem(Request $request, $id)
    {
        $item = ActivityItem::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'sort_order' => 'nullable|integer',
        ]);

        $item->update([
            'name' => $request->name,
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? $item->sort_order ?? 0,
        ]);

        return redirect()->back()->with('success', 'Activity item updated!');
    }

    public function destroyItem($id)
    {
        $item = ActivityItem::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Activity item deleted!');
    }

    public function destroyCategory($id)
    {
        $category = ActivityCategory::findOrFail($id);

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->back()->with('success', 'Category and its items deleted!');
    }
}
