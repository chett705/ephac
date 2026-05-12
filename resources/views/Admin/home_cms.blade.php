@extends('Admin.page.admin_layout')

@section('content')
    <div class="max-w-5xl mx-auto space-y-12 pb-20">

        {{-- Notification Messages --}}
        @if (session('success'))
            <div id="alert-success"
                class="flex items-center p-4 mb-4 text-green-800 rounded-2xl bg-green-50 border border-green-200 shadow-sm">
                <i class="fas fa-check-circle mr-3"></i>
                <div class="text-sm font-bold">{{ session('success') }}</div>
                <button type="button" onclick="this.parentElement.remove()"
                    class="ml-auto text-green-500 hover:text-green-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div id="alert-error"
                class="flex items-start p-4 mb-4 text-red-800 rounded-2xl bg-red-50 border border-red-200 shadow-sm">
                <i class="fas fa-exclamation-circle mt-1 mr-3"></i>
                <div>
                    <div class="text-sm font-bold">Please check the errors below:</div>
                    <ul class="mt-1 ml-4 list-disc list-inside text-xs">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" onclick="this.parentElement.remove()"
                    class="ml-auto text-red-500 hover:text-red-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        {{-- HERO SECTION --}}
        <section id="hero" class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800">Hero Section Management</h3>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.home.hero.update') }}" method="POST"
                    class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" name="title" value="{{ $hero->title ?? '' }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
                        <input type="text" name="subtitle" value="{{ $hero->subtitle ?? '' }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Video URL</label>
                        <input type="text" name="video_url" value="{{ $hero->video_url ?? '' }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" rows="3"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500">{{ $hero->description ?? '' }}</textarea>
                    </div>
                    <div class="flex justify-end md:col-span-2">
                        <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                            Update Hero
                        </button>
                    </div>
                </form>
            </div>
        </section>

        {{-- ABOUT SECTION --}}
        <section id="about" class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-800">About Us</h3>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.home.about.update') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">About Title</label>
                        <input type="text" name="title" value="{{ $about->title ?? '' }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" rows="5"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">{{ $about->description ?? '' }}</textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                            Update About
                        </button>
                    </div>
                </form>
            </div>
        </section>

        {{-- CATEGORY SECTIONS --}}
        @forelse($categories as $category)
            <section id="category-{{ $category->id }}"
                class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800">Category: {{ $category->name }}</h3>
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.home.category.update', $category->id) }}" method="POST"
                        enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                            <input type="text" name="name" value="{{ old('name', $category->name) }}"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea name="description" rows="3"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $category->description) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Change Image</label>
                                <input type="file" name="image" accept="image/*"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white">
                                <p class="text-xs text-gray-400 mt-1">JPG, PNG, WEBP (Max 9MB)</p>
                            </div>
                            <div class="flex justify-center">
                                @if ($category->image)
                                    <img src="{{ asset('uploads/categories/' . $category->image) }}"
                                        alt="{{ $category->name }}"
                                        class="w-32 h-32 object-cover rounded-xl border shadow-sm">
                                @else
                                    <div
                                        class="w-32 h-32 flex items-center justify-center border-2 border-dashed border-gray-300 rounded-xl text-gray-400 text-xs">
                                        No Image
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                                Update Category
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        @empty
            <div class="bg-white p-10 rounded-2xl border border-dashed border-gray-300 text-center text-gray-500">
                <i class="fas fa-folder-open text-4xl mb-3 block"></i>
                No categories found. Please add some categories in the Database.
            </div>
        @endforelse

        <section id="leadership" class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800">Leadership Management</h3>
                <button onclick="openLeaderModal()"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition">
                    <i class="fas fa-plus mr-2"></i> Add Leader
                </button>
            </div>

            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-gray-400 text-sm uppercase">
                                <th class="pb-4 font-medium">Member</th>
                                <th class="pb-4 font-medium">Position</th>
                                <th class="pb-4 font-medium text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($leaders as $leader)
                                <tr>
                                    <td class="py-4 flex items-center space-x-3">
                                        <img src="{{ asset('storage/' . $leader->image) }}"
                                            class="w-10 h-10 rounded-full object-cover">
                                        <span class="font-semibold text-gray-700">{{ $leader->name }}</span>
                                    </td>
                                    <td class="py-4 text-gray-600">{{ $leader->position }}</td>
                                    <td class="py-4 text-right space-x-2">
                                        <button onclick="openLeaderModal({{ $leader->toJson() }})"
                                            class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('admin.leadership.destroy', $leader->id) }}"
                                            method="POST" class="inline"
                                            onsubmit="return confirm('Delete this leader?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        {{-- MODAL --}}
        <div id="leaderModal"
            class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-900 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b flex justify-between items-center">
                    <h3 id="modalTitle" class="font-bold text-gray-800">Add New Leader</h3>
                    <button onclick="closeLeaderModal()" class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>

                <form id="leaderForm" action="{{ route('admin.leadership.store') }}" method="POST"
                    enctype="multipart/form-data" class="p-6 space-y-4">
                    @csrf
                    <div id="methodField"></div> {{-- For PUT method when editing --}}

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="name" id="leaderName" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Position</label>
                        <input type="text" name="position" id="leaderPosition" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Profile Image</label>
                        <input type="file" name="image" accept="image/*"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    <div class="flex justify-end pt-4 space-x-3">
                        <button type="button" onclick="closeLeaderModal()"
                            class="px-4 py-2 text-gray-600 hover:text-gray-800 font-medium">Cancel</button>
                        <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700">Save
                            Member</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
