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
                <form action="{{ route('admin.about.hero.update') }}" method="POST"
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

    </div>
@endsection
