@extends('Admin.page.admin_layout')

@section('content')
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <div x-data="{
        tab: 'products',
        categoryModal: false,
        editCategoryModal: false,
        subcategoryModal: false,
        editSubcategoryModal: false,
        productModal: false,
        editProductModal: false,
    
        // Edit Data States
        editCat: { id: '', title: '' },
        editSub: { id: '', catId: '', name: '', highlighted: false },
        editProd: { id: '', subId: '', name: '', desc: '', benefits: '', btnText: '' }
    }">

        {{-- HERO SECTION MANAGEMENT --}}
        <section id="hero" class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-8">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800">Hero Section Management</h3>
            </div>

            <div class="p-6">
                <form action="{{ route('admin.products.hero.update') }}" method="POST"
                    class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $hero->title ?? '') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
                        <input type="text" name="subtitle" value="{{ old('subtitle', $hero->subtitle ?? '') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Video URL</label>
                        <input type="url" name="video_url" value="{{ old('video_url', $hero->video_url ?? '') }}"
                            placeholder="https://..."
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" rows="4"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('description', $hero->description ?? '') }}</textarea>
                    </div>

                    <div class="md:col-span-2 flex justify-end">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-200">
                            Update Hero Section
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <section id="" class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-8">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800">Hero Section Management</h3>
            </div>
            <div class="p-6">
                <div class="container mx-auto">


                    <!-- Tabs -->
                    <div class="mb-6 flex flex-wrap gap-2 border-b pb-3">
                        <button @click="tab = 'categories'"
                            :class="tab === 'categories' ? 'bg-blue-50 text-blue-600 ring-1 ring-blue-200' :
                                'text-gray-500 hover:text-gray-700'"
                            class="rounded-lg px-4 py-2 font-semibold transition">Categories</button>
                        <button @click="tab = 'subcategories'"
                            :class="tab === 'subcategories' ? 'bg-blue-50 text-blue-600 ring-1 ring-blue-200' :
                                'text-gray-500 hover:text-gray-700'"
                            class="rounded-lg px-4 py-2 font-semibold transition">Subcategories</button>
                        <button @click="tab = 'products'"
                            :class="tab === 'products' ? 'bg-blue-50 text-blue-600 ring-1 ring-blue-200' :
                                'text-gray-500 hover:text-gray-700'"
                            class="rounded-lg px-4 py-2 font-semibold transition">Products</button>
                    </div>

                    <!-- Alerts -->
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}</div>
                    @endif

                    <!-- CATEGORIES TAB -->
                    <div x-show="tab === 'categories'" x-cloak>
                        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                            <h2 class="text-xl font-bold text-gray-700">Categories</h2>
                            <button @click="categoryModal = true"
                                class="rounded bg-blue-600 px-4 py-2 font-semibold text-white hover:bg-blue-700">Add
                                Category</button>
                        </div>
                        <div class="bg-white rounded shadow overflow-hidden">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
                                    <tr>
                                        <th class="px-6 py-3">ID</th>
                                        <th class="px-6 py-3">Title</th>
                                        <th class="px-6 py-3 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productCategories as $cat)
                                        <tr class="border-b hover:bg-gray-50 transition">
                                            <td class="px-6 py-4">{{ $cat->id }}</td>
                                            <td class="px-6 py-4 font-medium">{{ $cat->title }}</td>
                                            <td class="px-6 py-4 text-right flex justify-end gap-3">
                                                <button
                                                    @click="editCat = {id: '{{ $cat->id }}', title: @js($cat->title)}; editCategoryModal = true"
                                                    class="text-blue-500 hover:underline">Edit</button>
                                                <form action="{{ route('admin.product.category.destroy', $cat->id) }}"
                                                    method="POST" onsubmit="return confirm('Delete category?')">
                                                    @csrf @method('DELETE')
                                                    <button class="text-red-500 hover:underline">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- SUBCATEGORIES TAB -->
                    <div x-show="tab === 'subcategories'" x-cloak>
                        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                            <h2 class="text-xl font-bold text-gray-700">Subcategories</h2>
                            <button @click="subcategoryModal = true"
                                class="rounded bg-blue-600 px-4 py-2 font-semibold text-white hover:bg-blue-700">Add
                                Subcategory</button>
                        </div>
                        <div class="bg-white rounded shadow overflow-hidden">
                            <table class="w-full text-left">
                                <thead class="bg-gray-100 text-gray-600">
                                    <tr>
                                        <th class="px-6 py-3">Category</th>
                                        <th class="px-6 py-3">Name</th>
                                        <th class="px-6 py-3">Description</th>
                                        <th class="px-6 py-3">Highlighted</th>
                                        <th class="px-6 py-3 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productSubcategories as $sub)
                                        <tr class="border-b hover:bg-gray-50">
                                            <td class="px-6 py-4 text-gray-500">{{ $sub->category->title ?? 'N/A' }}</td>
                                            <td class="px-6 py-4 font-medium">{{ $sub->name }}</td>
                                            <td class="px-6 py-4 ">{{ $sub->desc }}</td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="px-2 py-1 text-xs rounded {{ $sub->highlighted ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                                    {{ $sub->highlighted ? 'Yes' : 'No' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-right flex justify-end gap-3">
                                                <button
                                                    @click="editSub = {id: '{{ $sub->id }}', catId: '{{ $sub->category_id }}', name: @js($sub->name), highlighted: {{ $sub->highlighted ? 'true' : 'false' }}}; editSubcategoryModal = true"
                                                    class="text-blue-500 hover:underline">Edit</button>
                                                <form action="{{ route('admin.product.subcategory.destroy', $sub->id) }}"
                                                    method="POST">
                                                    @csrf @method('DELETE')
                                                    <button class="text-red-500 hover:underline">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- PRODUCTS TAB -->
                    <div x-show="tab === 'products'" x-cloak>
                        <div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                            <h2 class="text-xl font-bold text-gray-700">Products</h2>
                            <button @click="productModal = true"
                                class="rounded bg-blue-600 px-4 py-2 font-semibold text-white hover:bg-blue-700">Add
                                Product</button>
                        </div>
                        <div class="bg-white rounded shadow overflow-hidden">
                            <table class="w-full text-left">
                                <thead class="bg-gray-100 text-gray-600">
                                    <tr>
                                        <th class="px-6 py-3">Image</th>
                                        <th class="px-6 py-3">Name</th>
                                        <th class="px-6 py-3">Subcategory</th>
                                        <th class="px-6 py-3 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $prod)
                                        <tr class="border-b hover:bg-gray-50">
                                            <td class="px-6 py-4">
                                                <img src="{{ $prod->image ? asset('storage/' . $prod->image) : asset('no-image.png') }}"
                                                    class="w-12 h-12 object-cover rounded border">
                                            </td>
                                            <td class="px-6 py-4 font-medium">{{ $prod->name }}</td>
                                            <td class="px-6 py-4 text-gray-500">{{ $prod->subcategory->name ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 text-right flex justify-end gap-3">
                                                <button
                                                    @click="editProd = {
                                    id: '{{ $prod->id }}', 
                                    subId: '{{ $prod->subcategory_id }}', 
                                    name: @js($prod->name), 
                                    desc: @js($prod->description), 
                                    benefits: @js($prod->benefits), 
                                    btnText: @js($prod->button_text)
                                }; editProductModal = true"
                                                    class="text-blue-500 hover:underline">Edit</button>
                                                <form action="{{ route('admin.product.destroy', $prod->id) }}"
                                                    method="POST">
                                                    @csrf @method('DELETE')
                                                    <button class="text-red-500 hover:underline">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- MODAL WRAPPERS --}}

                <!-- Add Category Modal -->
                <div class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/50" x-show="categoryModal"
                    x-cloak x-transition>
                    <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6" @click.away="categoryModal = false">
                        <h3 class="text-xl font-bold mb-4">Add Category</h3>
                        <form action="{{ route('admin.product.category.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-1">Title</label>
                                <input type="text" name="title" required
                                    class="w-full border rounded-lg p-2 outline-blue-500">
                            </div>
                            <div class="flex justify-end gap-2">
                                <button type="button" @click="categoryModal = false"
                                    class="px-4 py-2 bg-gray-100 rounded-lg">Cancel</button>
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Edit Category Modal -->
                <div class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/50"
                    x-show="editCategoryModal" x-cloak x-transition>
                    <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6"
                        @click.away="editCategoryModal = false">
                        <h3 class="text-xl font-bold mb-4">Edit Category</h3>
                        <form :action="`/admin/products-cms/category/${editCat.id}`" method="POST">
                            @csrf @method('PUT')
                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-1">Title</label>
                                <input type="text" name="title" x-model="editCat.title" required
                                    class="w-full border rounded-lg p-2 outline-blue-500">
                            </div>
                            <div class="flex justify-end gap-2">
                                <button type="button" @click="editCategoryModal = false"
                                    class="px-4 py-2 bg-gray-100 rounded-lg">Cancel</button>
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Add Subcategory Modal -->
                <div class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/50"
                    x-show="subcategoryModal" x-cloak x-transition>
                    <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6" @click.away="subcategoryModal = false">
                        <h3 class="text-xl font-bold mb-4">Add Subcategory</h3>
                        <form action="{{ route('admin.product.subcategory.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-1">Parent Category</label>
                                <select name="category_id" required class="w-full border rounded-lg p-2">
                                    @foreach ($productCategories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-1">Name</label>
                                <input type="text" name="name" required class="w-full border rounded-lg p-2">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-1">Description</label>
                                <input type="text" name="desc" required class="w-full border rounded-lg p-2">
                            </div>
                            <div class="mb-4 flex items-center">
                                <input type="checkbox" name="highlighted" value="1" id="h-add" class="mr-2">
                                <label for="h-add" class="text-sm">Highlight this subcategory</label>
                            </div>
                            <div class="flex justify-end gap-2">
                                <button type="button" @click="subcategoryModal = false"
                                    class="px-4 py-2 bg-gray-100 rounded-lg">Cancel</button>
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Edit Subcategory Modal -->
                <div class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/50"
                    x-show="editSubcategoryModal" x-cloak x-transition>
                    <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6"
                        @click.away="editSubcategoryModal = false">
                        <h3 class="text-xl font-bold mb-4">Edit Subcategory</h3>
                        <form :action="`/admin/products-cms/subcategory/${editSub.id}`" method="POST">
                            @csrf @method('PUT')
                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-1">Parent Category</label>
                                <select name="category_id" x-model="editSub.catId" class="w-full border rounded-lg p-2">
                                    @foreach ($productCategories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-1">Name</label>
                                <input type="text" name="name" x-model="editSub.name" required
                                    class="w-full border rounded-lg p-2">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-1">Description</label>
                                <input type="text" name="desc" x-model="editSub.desc" required
                                    class="w-full border rounded-lg p-2">
                            </div>
                            <div class="mb-4 flex items-center">
                                <input type="checkbox" name="highlighted" value="1" x-model="editSub.highlighted"
                                    id="h-edit" class="mr-2">
                                <label for="h-edit" class="text-sm">Highlighted</label>
                            </div>
                            <div class="flex justify-end gap-2">
                                <button type="button" @click="editSubcategoryModal = false"
                                    class="px-4 py-2 bg-gray-100 rounded-lg">Cancel</button>
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Product Modal (Add/Edit logic combined) -->
                <div class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/50 overflow-y-auto"
                    x-show="productModal" x-cloak x-transition>
                    <div class="bg-white rounded-xl shadow-xl w-full max-w-2xl p-6 my-8"
                        @click.away="productModal = false">
                        <h3 class="text-xl font-bold mb-4">Add New Product</h3>
                        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium">Subcategory</label>
                                    <select name="subcategory_id" class="w-full border rounded-lg p-2">
                                        @foreach ($productSubcategories as $sub)
                                            <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium">Name</label>
                                    <input type="text" name="name" required class="w-full border rounded-lg p-2">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium">Image</label>
                                <input type="file" name="image" class="w-full border rounded-lg p-1">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium">Description</label>
                                <textarea name="description" rows="3" class="w-full border rounded-lg p-2"></textarea>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium">Benefits</label>
                                <textarea name="benefits" x-model="editProd.benefits" rows="2" class="w-full border rounded-lg p-2"></textarea>
                            </div>
                            <div class="flex justify-end gap-2">
                                <button type="button" @click="productModal = false"
                                    class="px-4 py-2 bg-gray-100 rounded-lg">Cancel</button>
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Save
                                    Product</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Edit Product Modal -->
                <div class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/50 overflow-y-auto"
                    x-show="editProductModal" x-cloak x-transition>
                    <div class="bg-white rounded-xl shadow-xl w-full max-w-2xl p-6 my-8"
                        @click.away="editProductModal = false">
                        <h3 class="text-xl font-bold mb-4">Edit Product</h3>
                        <form :action="`/admin/products-cms/product/${editProd.id}`" method="POST"
                            enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium">Subcategory</label>
                                    <select name="subcategory_id" x-model="editProd.subId"
                                        class="w-full border rounded-lg p-2">
                                        @foreach ($productSubcategories as $sub)
                                            <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium">Name</label>
                                    <input type="text" name="name" x-model="editProd.name" required
                                        class="w-full border rounded-lg p-2">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium">Image</label>
                                <input type="file" name="image" class="w-full border rounded-lg p-1">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium">Description</label>
                                <textarea name="description" x-model="editProd.desc" rows="3" class="w-full border rounded-lg p-2"></textarea>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium">Benefits</label>
                                <textarea name="benefits" x-model="editProd.benefits" rows="2" class="w-full border rounded-lg p-2"></textarea>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium">Button Text</label>
                                <input type="text" name="button_text" x-model="editProd.btnText"
                                    class="w-full border rounded-lg p-2">
                            </div>
                            <div class="flex justify-end gap-2">
                                <button type="button" @click="editProductModal = false"
                                    class="px-4 py-2 bg-gray-100 rounded-lg">Cancel</button>
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Update
                                    Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>




    </div>
@endsection
