@extends('Admin.page.admin_layout')

@section('content')
    <div class="mx-auto max-w-5xl space-y-8 pb-12 sm:space-y-12 sm:pb-20">

        {{-- Notification Messages --}}
        @if (session('success'))
            <div id="alert-success" class="flex items-center p-4 mb-4 text-green-800 rounded-2xl bg-green-50 border border-green-200 shadow-sm">
                <i class="fas fa-check-circle mr-3"></i>
                <div class="text-sm font-bold">{{ session('success') }}</div>
                <button type="button" onclick="this.parentElement.remove()" class="ml-auto text-green-500 hover:text-green-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 rounded-2xl border border-red-200 bg-red-50 p-4 text-red-800 shadow-sm">
                <div class="mb-2 text-sm font-bold">Please fix these errors:</div>
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- 1. ADD NEW CATEGORY SECTION --}}
        <section id="add-category" class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b border-gray-200 bg-gray-50 px-4 py-4 sm:px-6">
                <h3 class="text-lg font-bold text-gray-800">Create Activity Category</h3>
            </div>
            <div class="p-4 sm:p-6">
                <!-- ✅ FIXED: Correct route for creating category -->
                <form action="{{ route('admin.activities.category.store') }}" 
                      method="POST" 
                      enctype="multipart/form-data" 
                      class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf
                    <div class="md:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category Title</label>
                        <input type="text" name="title" required placeholder="e.g. Medical & Healthcare"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Image (Optional)</label>
                        <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/webp"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <div class="md:col-span-2 flex justify-end">
                        <button type="submit" class="rounded-lg bg-green-600 px-6 py-2.5 font-semibold text-white transition hover:bg-green-700">
                            Save Category
                        </button>
                    </div>
                </form>
            </div>
        </section>

        {{-- 2. EXISTING ACTIVITIES LIST --}}
        <section id="activity-list" class="space-y-6">
            <h3 class="text-xl font-bold text-gray-800 px-2">Manage Activity Items</h3>
           
            @foreach($categories as $category)
                <div x-data="{ editCategory: false }" class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                    {{-- Category Header --}}
                    <div class="flex items-center justify-between bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center space-x-4">
                            @if($category->image)
                                <img src="{{ asset('storage/'.$category->image) }}" 
                                     class="h-10 w-10 rounded-lg object-cover">
                            @endif
                            <span class="font-bold text-gray-700">{{ $category->title }}</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <button type="button"
                                @click="editCategory = !editCategory"
                                class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                <i class="fas fa-pen mr-1"></i> Edit Section
                            </button>
                            <form action="{{ route('admin.activities.destroy', $category->id) }}" 
                                method="POST" 
                                onsubmit="return confirm('Delete this category and all its items?')">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium">
                                    <i class="fas fa-trash-alt mr-1"></i> Delete Section
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="p-6">
                        <div x-show="editCategory" x-cloak class="mb-6 rounded-xl border border-amber-200 bg-amber-50 p-4">
                            <p class="mb-3 text-sm font-bold text-amber-800">Edit Category</p>
                            <form action="{{ route('admin.activities.category.update', $category->id) }}"
                                method="POST"
                                enctype="multipart/form-data"
                                class="grid grid-cols-1 gap-4 md:grid-cols-3">
                                @csrf
                                @method('PUT')
                                <div>
                                    <input type="text" name="title" value="{{ $category->title }}" required
                                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-amber-500">
                                </div>
                                <div>
                                    <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/webp"
                                        class="w-full text-sm text-gray-500 file:mr-4 file:rounded-full file:border-0 file:bg-amber-100 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-amber-800 hover:file:bg-amber-200">
                                </div>
                                <div class="flex items-center gap-3">
                                    <button type="submit" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-semibold text-white hover:bg-amber-600">
                                        Update Category
                                    </button>
                                    <button type="button" @click="editCategory = false" class="text-sm font-medium text-gray-600 hover:text-gray-800">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- List of Sub-Items --}}
                        <div class="mb-6 space-y-2">
                            <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider">Current Links (Dropdowns)</h4>
                            @forelse($category->items as $item)
                                <div x-data="{ editItem: false }" class="rounded-xl border border-blue-100 bg-blue-50 p-3">
                                    <div class="flex items-start justify-between gap-4">
                                        <div>
                                            <span class="font-bold text-blue-900">{{ $item->name }}</span>
                                            <p class="max-w-md truncate text-xs text-blue-700">{{ $item->description }}</p>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <button type="button" @click="editItem = !editItem" class="text-xs font-semibold text-blue-700 hover:text-blue-900">
                                                Edit
                                            </button>
                                            <form action="{{ route('admin.activities.item.destroy', $item->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Delete this item?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs font-semibold text-red-600 hover:text-red-800">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <form x-show="editItem"
                                        x-cloak
                                        action="{{ route('admin.activities.item.update', $item->id) }}"
                                        method="POST"
                                        class="mt-4 grid grid-cols-1 gap-3 md:grid-cols-3">
                                        @csrf
                                        @method('PUT')
                                        <div>
                                            <input type="text" name="name" value="{{ $item->name }}" required
                                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                                        </div>
                                        <div>
                                            <input type="text" name="description" value="{{ $item->description }}" required
                                                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-bold text-white hover:bg-blue-700">
                                                Update Link
                                            </button>
                                            <button type="button" @click="editItem = false" class="text-sm font-medium text-gray-600 hover:text-gray-800">
                                                Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @empty
                                <p class="text-sm text-gray-400 italic">No items added yet.</p>
                            @endforelse
                        </div>

                        {{-- Form to Add New Sub-Item --}}
                        <div class="pt-4 border-t border-dashed border-gray-200">
                            <p class="text-sm font-bold text-gray-700 mb-3">Add New Sub-link for this Category</p>
                            <form action="{{ route('admin.activities.item.store', $category->id) }}" 
                                  method="POST" 
                                  class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @csrf
                                <div class="md:col-span-1">
                                    <input type="text" name="name" required placeholder="Link Name (e.g. Factory Audit)"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div class="md:col-span-1">
                                    <input type="text" name="description" required placeholder="Description (shows on click)"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <button type="submit" class="bg-blue-600 text-white rounded-lg px-4 py-2 text-sm font-bold hover:bg-blue-700 transition">
                                    + Add Link
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </section>

    </div>
@endsection
