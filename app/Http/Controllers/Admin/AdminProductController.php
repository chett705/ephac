<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;

class AdminProductController extends Controller
{
    // hero
    // public function productPage1()
    // {
    //     $hero = $this->safeFirst(new Hero());


    //     return view('Frontend.Pages.AboutUs', compact(
    //         'hero',
    //     ));
    // }

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
    public function productCms()
    {
        $hero = Hero::find(3);


        return view('Admin.product_cms', compact(
            'hero'

        ));
    }


    public function updateHero(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'video_url'   => 'nullable|url|max:500',   // Better validation
        ]);

        $data = $request->only(['title', 'subtitle', 'description', 'video_url']);
        $data['order'] = 3;

        Hero::updateOrCreate(['id' => 3], $data);

        return redirect()->back()->with('success', 'Hero section updated successfully!');
    }


    //-----------------------------------------------------
    public function productPage()
    {
        $productCategories = $this->safeFrontendCategories();
         $hero = $this->safeFirst(new Hero());

        return view('Frontend.Pages.Product', compact('productCategories','hero'));
    }

    public function index()
    {
        $productCategories = $this->safeProductCategories();
        $productSubcategories = $this->safeProductSubcategories();
        $products = $this->safeProducts();
        $hero = $this->safeFirst(new Hero());

        return view('Admin.product_cms', compact(
            'productCategories',
            'productSubcategories',
            'products',
            'hero'
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
        $data = $this->validateProduct($request);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');

            if (!$path) {
                throw ValidationException::withMessages([
                    'image' => 'The image could not be saved. Please try again.',
                ]);
            }

            $data['image'] = $path;
        }

        Product::create($data);

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $this->validateProduct($request);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $path = $request->file('image')->store('products', 'public');

            if (!$path) {
                throw ValidationException::withMessages([
                    'image' => 'The image could not be saved. Please try again.',
                ]);
            }

            $data['image'] = $path;
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

    public function storeCategory(Request $request)
    {
        $request->validate(['title' => 'required|string|max:255']);
        ProductCategory::create($request->all());
        return redirect()->back()->with('success', 'Category added successfully!');
    }

    public function updateCategory(Request $request, $id)
    {
        $category = ProductCategory::findOrFail($id);
        $request->validate(['title' => 'required|string|max:255']);
        $category->update($request->all());
        return redirect()->back()->with('success', 'Category updated successfully!');
    }

    public function destroyCategory($id)
    {
        ProductCategory::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Category deleted successfully.');
    }

    public function storeSubcategory(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'desc' => 'required|string|max:255'
        ]);
        $data = $request->all();
        $data['highlighted'] = $request->has('highlighted');
        ProductSubcategory::create($data);
        return redirect()->back()->with('success', 'Subcategory added successfully!');
    }

    public function updateSubcategory(Request $request, $id)
    {
        $subcategory = ProductSubcategory::findOrFail($id);
        $request->validate([
            'category_id' => 'required|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'desc' => 'required|string|max:255',
        ]);
        $data = $request->all();
        $data['highlighted'] = $request->has('highlighted');
        $subcategory->update($data);
        return redirect()->back()->with('success', 'Subcategory updated successfully!');
    }

    public function destroySubcategory($id)
    {
        ProductSubcategory::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Subcategory deleted successfully.');
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

    protected function safeFrontendCategories()
    {
        if (
            !Schema::hasTable((new ProductCategory())->getTable()) ||
            !Schema::hasTable((new ProductSubcategory())->getTable()) ||
            !Schema::hasTable((new Product())->getTable())
        ) {
            return collect();
        }

        return ProductCategory::with([
            'subcategories' => fn($query) => $query
                ->with(['products' => fn($productQuery) => $productQuery->latest()])
                ->orderByDesc('highlighted')
                ->orderBy('name'),
        ])->orderBy('title')->get();
    }

    protected function validateProduct(Request $request): array
    {
        $maxUploadKilobytes = min(8192, $this->serverUploadLimitInKilobytes());
        $maxUploadMegabytes = max(1, (int) floor($maxUploadKilobytes / 1024));

        return $request->validate([
            'subcategory_id' => 'required|exists:product_subcategories,id',
            'name' => 'required|string|max:255',
            'image' => "nullable|image|mimes:webp,jpeg,png,jpg|max:{$maxUploadKilobytes}",
            'description' => 'nullable|string',
            'benefits' => 'nullable|string',
            'button_text' => 'nullable|string|max:100',
        ], [
            'image.uploaded' => "The image failed to upload. Please use an image under {$maxUploadMegabytes}MB and try again.",
            'image.max' => "The image must be {$maxUploadMegabytes}MB or smaller.",
        ]);
    }

    protected function serverUploadLimitInKilobytes(): int
    {
        $uploadMax = $this->iniSizeToKilobytes((string) ini_get('upload_max_filesize'));
        $postMax = $this->iniSizeToKilobytes((string) ini_get('post_max_size'));

        return max(1, min($uploadMax, $postMax));
    }

    protected function iniSizeToKilobytes(string $value): int
    {
        $value = trim($value);

        if ($value === '') {
            return 2048;
        }

        $number = (float) $value;
        $unit = strtolower(substr($value, -1));

        return match ($unit) {
            'g' => (int) ($number * 1024 * 1024),
            'm' => (int) ($number * 1024),
            'k' => (int) $number,
            default => (int) ceil($number / 1024),
        };
    }
}
