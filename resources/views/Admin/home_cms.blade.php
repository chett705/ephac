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
                <h3 class="text-lg font-bold text-gray-800">About </h3>
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


        {{-- CATEGORY MANAGEMENT --}}
        <section id="categories" class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800">Category Management</h3>
                <button type="button" onclick="openCategoryModal()"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition">
                    <i class="fas fa-plus mr-2"></i> Add Category
                </button>
            </div>

            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-gray-400 text-sm uppercase">
                                <th class="pb-4 font-medium">Category</th>
                                <th class="pb-4 font-medium">Description</th>
                                <th class="pb-4 font-medium text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($categories as $category)
                                <tr>
                                    <td class="py-4">
                                        <div class="flex items-center space-x-3">
                                            @if ($category->image)
                                                <img src="{{ asset('uploads/categories/' . $category->image) }}"
                                                    alt="{{ $category->name }}"
                                                    class="w-10 h-10 rounded-lg object-cover">
                                            @else
                                                <div
                                                    class="w-10 h-10 rounded-lg bg-gray-100 text-gray-400 flex items-center justify-center">
                                                    <i class="fas fa-box"></i>
                                                </div>
                                            @endif
                                            <span class="font-semibold text-gray-700">{{ $category->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 text-gray-600 max-w-sm">
                                        {{ \Illuminate\Support\Str::limit($category->description, 80) ?: 'No description' }}
                                    </td>
                                    <td class="py-4 text-right space-x-2">
                                        <button type="button"
                                            onclick='openCategoryModal(@json(["id" => $category->id, "name" => $category->name, "description" => $category->description]))'
                                            class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('admin.home.category.destroy', $category->id) }}"
                                            method="POST" class="inline"
                                            onsubmit="return confirm('Delete this category?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-6 text-center text-gray-500">No categories found yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

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
                            @forelse ($teams as $leader)
                                <tr>
                                    <td class="py-4 flex items-center space-x-3">
                                        @if ($leader->image)
                                            <img src="{{ asset('storage/' . $leader->image) }}"
                                                class="w-10 h-10 rounded-full object-cover" alt="{{ $leader->name }}">
                                        @else
                                            <div
                                                class="w-10 h-10 rounded-full bg-gray-100 text-gray-400 flex items-center justify-center">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        @endif
                                        <span class="font-semibold text-gray-700">{{ $leader->name }}</span>
                                    </td>
                                    <td class="py-4 text-gray-600">{{ $leader->position }}</td>
                                    <td class="py-4 text-right space-x-2">
                                        <button type="button" onclick='openLeaderModal(@json(['id' => $leader->id, 'name' => $leader->name, 'position' => $leader->position]))'
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
                            @empty
                                <tr>
                                    <td colspan="3" class="py-6 text-center text-gray-500">No leaders added yet.</td>
                                </tr>
                            @endforelse
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

        {{-- CERTIFICATE MANAGEMENT --}}
        <section id="certificates" class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800">Certificate Management</h3>
                <button type="button" onclick="openCertificateModal()"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition">
                    <i class="fas fa-plus mr-2"></i> Add Certificate
                </button>
            </div>

            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-gray-400 text-sm uppercase">
                                <th class="pb-4 font-medium">Certificate</th>
                                <th class="pb-4 font-medium">Preview</th>
                                <th class="pb-4 font-medium text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($certificates as $certificate)
                                <tr>
                                    <td class="py-4 font-semibold text-gray-700">{{ $certificate->title }}</td>
                                    <td class="py-4">
                                        @if ($certificate->image)
                                            <img src="{{ asset('storage/' . $certificate->image) }}"
                                                alt="{{ $certificate->title }}"
                                                class="w-16 h-12 object-cover rounded-lg border">
                                        @else
                                            <span class="text-gray-400 text-sm">No image</span>
                                        @endif
                                    </td>
                                    <td class="py-4 text-right space-x-2">
                                        <button type="button"
                                            onclick='openCertificateModal(@json(["id" => $certificate->id, "title" => $certificate->title]))'
                                            class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('admin.certificate.destroy', $certificate->id) }}"
                                            method="POST" class="inline"
                                            onsubmit="return confirm('Delete this certificate?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-6 text-center text-gray-500">No certificates found yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <div id="categoryModal"
            class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-900 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl mx-4 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b flex justify-between items-center">
                    <h3 id="categoryModalTitle" class="font-bold text-gray-800">Add New Category</h3>
                    <button type="button" onclick="closeCategoryModal()"
                        class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>

                <form id="categoryForm" action="{{ route('admin.home.category.store') }}" method="POST"
                    enctype="multipart/form-data" class="p-6 space-y-4">
                    @csrf
                    <div id="categoryMethodField"></div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                        <input type="text" name="name" id="categoryName" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" id="categoryDescription" rows="4"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category Image</label>
                        <input type="file" name="image" id="categoryImage" accept="image/*"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p id="categoryImageHint" class="text-xs text-gray-400 mt-1">Image is required for new category.</p>
                    </div>

                    <div class="flex justify-end pt-4 space-x-3">
                        <button type="button" onclick="closeCategoryModal()"
                            class="px-4 py-2 text-gray-600 hover:text-gray-800 font-medium">Cancel</button>
                        <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700">
                            Save Category
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div id="certificateModal"
            class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-900 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b flex justify-between items-center">
                    <h3 id="certificateModalTitle" class="font-bold text-gray-800">Add New Certificate</h3>
                    <button type="button" onclick="closeCertificateModal()"
                        class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>

                <form id="certificateForm" action="{{ route('admin.certificate.store') }}" method="POST"
                    enctype="multipart/form-data" class="p-6 space-y-4">
                    @csrf
                    <div id="certificateMethodField"></div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" name="title" id="certificateTitle" required
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Certificate Image</label>
                        <input type="file" name="image" id="certificateImage" accept="image/*"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p id="certificateImageHint" class="text-xs text-gray-400 mt-1">Image is required for new certificate.</p>
                    </div>

                    <div class="flex justify-end pt-4 space-x-3">
                        <button type="button" onclick="closeCertificateModal()"
                            class="px-4 py-2 text-gray-600 hover:text-gray-800 font-medium">Cancel</button>
                        <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700">
                            Save Certificate
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- QUALITY MANAGEMENT --}}
       

    </div>
@endsection

@push('scripts')
    <script>
        const categoryModal = document.getElementById('categoryModal');
        const categoryForm = document.getElementById('categoryForm');
        const categoryModalTitle = document.getElementById('categoryModalTitle');
        const categoryMethodField = document.getElementById('categoryMethodField');
        const categoryName = document.getElementById('categoryName');
        const categoryDescription = document.getElementById('categoryDescription');
        const categoryImage = document.getElementById('categoryImage');
        const categoryImageHint = document.getElementById('categoryImageHint');

        const leaderModal = document.getElementById('leaderModal');
        const leaderForm = document.getElementById('leaderForm');
        const modalTitle = document.getElementById('modalTitle');
        const methodField = document.getElementById('methodField');
        const leaderName = document.getElementById('leaderName');
        const leaderPosition = document.getElementById('leaderPosition');

        const certificateModal = document.getElementById('certificateModal');
        const certificateForm = document.getElementById('certificateForm');
        const certificateModalTitle = document.getElementById('certificateModalTitle');
        const certificateMethodField = document.getElementById('certificateMethodField');
        const certificateTitle = document.getElementById('certificateTitle');
        const certificateImage = document.getElementById('certificateImage');
        const certificateImageHint = document.getElementById('certificateImageHint');

        function openCategoryModal(category = null) {
            if (category) {
                categoryModalTitle.textContent = 'Edit Category';
                categoryForm.action = `/admin/home-cms/category/${category.id}`;
                categoryMethodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';
                categoryName.value = category.name ?? '';
                categoryDescription.value = category.description ?? '';
                categoryImage.required = false;
                categoryImageHint.textContent = 'Upload a new image only if you want to replace the current one.';
            } else {
                categoryModalTitle.textContent = 'Add New Category';
                categoryForm.action = '{{ route('admin.home.category.store') }}';
                categoryMethodField.innerHTML = '';
                categoryForm.reset();
                categoryImage.required = true;
                categoryImageHint.textContent = 'Image is required for new category.';
            }

            categoryModal.classList.remove('hidden');
        }

        function closeCategoryModal() {
            categoryModal.classList.add('hidden');
        }

        function openLeaderModal(leader = null) {
            if (leader) {
                modalTitle.textContent = 'Edit Leader';
                leaderForm.action = `/admin/home-cms/leadership/${leader.id}`;
                methodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';
                leaderName.value = leader.name ?? '';
                leaderPosition.value = leader.position ?? '';
            } else {
                modalTitle.textContent = 'Add New Leader';
                leaderForm.action = '{{ route('admin.leadership.store') }}';
                methodField.innerHTML = '';
                leaderForm.reset();
            }

            leaderModal.classList.remove('hidden');
        }

        function closeLeaderModal() {
            leaderModal.classList.add('hidden');
        }

        function openCertificateModal(certificate = null) {
            if (certificate) {
                certificateModalTitle.textContent = 'Edit Certificate';
                certificateForm.action = `/admin/home-cms/certificate/${certificate.id}`;
                certificateMethodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';
                certificateTitle.value = certificate.title ?? '';
                certificateImage.required = false;
                certificateImageHint.textContent = 'Upload a new image only if you want to replace the current one.';
            } else {
                certificateModalTitle.textContent = 'Add New Certificate';
                certificateForm.action = '{{ route('admin.certificate.store') }}';
                certificateMethodField.innerHTML = '';
                certificateForm.reset();
                certificateImage.required = true;
                certificateImageHint.textContent = 'Image is required for new certificate.';
            }

            certificateModal.classList.remove('hidden');
        }

        function closeCertificateModal() {
            certificateModal.classList.add('hidden');
        }

        window.addEventListener('click', function(event) {
            if (event.target === categoryModal) {
                closeCategoryModal();
            }

            if (event.target === leaderModal) {
                closeLeaderModal();
            }

            if (event.target === certificateModal) {
                closeCertificateModal();
            }
        });
    </script>
@endpush
