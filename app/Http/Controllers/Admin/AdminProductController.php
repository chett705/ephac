<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;

class AdminProductController extends Controller
{
    public function index()
    {
        $productCategories = $this->safeProductCategories();
        $productSubcategories = $this->safeProductSubcategories();
        $products = $this->safeProducts();

        return view('Admin.product_cms', compact(
            'productCategories',
            'productSubcategories',
            'products'
        ));
    }

    public function listProducts($subcategoryId)
    {
        $selectedSubcategory = ProductSubcategory::with('category')->findOrFail($subcategoryId);
        $productCategories = $this->safeProductCategories();
        $productSubcategories = $this->safeProductSubcategories();
        $products = Product::where('subcategory_id', $subcategoryId)->latest()->get();

        return view('Admin.product_cms', compact(
            'selectedSubcategory',
            'productCategories',
            'productSubcategories',
            'products'
        ));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'subcategory_id' => 'required|exists:product_subcategories,id',
            'name'           => 'required|string|max:255',
            'image'          => 'nullable|image|mimes:webp,jpeg,png,jpg|max:2048',
            'description'    => 'nullable|string',
            'benefits'       => 'nullable|string',
            'button_text'    => 'nullable|string|max:100',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'subcategory_id' => 'required|exists:product_subcategories,id',
            'name'           => 'required|string|max:255',
            'image'          => 'nullable|image|mimes:webp,jpeg,png,jpg|max:2048',
            'description'    => 'nullable|string',
            'benefits'       => 'nullable|string',
            'button_text'    => 'nullable|string|max:100',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->back()->with('success', 'Product updated successfully!');
    }

    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->back()->with('success', 'Product deleted permanently.');
    }

    public function getSubcategories($categoryId)
    {
        $subcategories = ProductSubcategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }

    protected function safeProductCategories()
    {
        if (!Schema::hasTable((new ProductCategory())->getTable())) {
            return collect();
        }

        return ProductCategory::withCount('subcategories')->latest()->get();
    }

    protected function safeProductSubcategories()
    {
        if (!Schema::hasTable((new ProductSubcategory())->getTable())) {
            return collect();
        }

        return ProductSubcategory::with('category')->latest()->get();
    }

    protected function safeProducts()
    {
        if (!Schema::hasTable((new Product())->getTable())) {
            return collect();
        }

        return Product::with('subcategory.category')->latest()->get();
    }
}
