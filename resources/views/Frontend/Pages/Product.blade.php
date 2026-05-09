@extends('Frontend.Layout.Main')

@php
    $categories = [
        [
            'title' => 'Core Therapeutic Categories',
            'items' => [
                ['name' => 'Pain Relief & Anti-inflammatory', 'highlighted' => true],
                ['name' => 'Antibiotics & Antibacterial'],
                ['name' => 'Antiparasitic & Anthelmintic'],
                ['name' => 'Antifungal'],
                ['name' => 'Antiviral'],
            ],
        ],
        [
            'title' => 'Respiratory & ENT',
            'items' => [
                ['name' => 'Cold & Flu Treatment'],
                ['name' => 'Cough & Respiratory Care'],
                ['name' => 'Allergy & Antihistamines'],
            ],
        ],
        [
            'title' => 'Cardiovascular & Metabolic',
            'items' => [
                ['name' => 'Cardiovascular (Blood Pressure / Heart)'],
                ['name' => 'Diabetes Management'],
                ['name' => 'Cholesterol Management'],
            ],
        ],
        [
            'title' => 'Neurology & Mental Health',
            'items' => [['name' => 'Neurological & Nerve Support'], ['name' => 'Sedatives & Sleep Support']],
        ],
        [
            'title' => 'Digestive System',
            'items' => [
                ['name' => 'Gastrointestinal (Stomach & Digestive)'],
                ['name' => 'Anti-ulcer & Acid Control'],
                ['name' => 'Anti-diarrheal'],
            ],
        ],
        [
            'title' => 'Women & General Health',
            'items' => [
                ['name' => 'Women\'s Health'],
                ['name' => 'Multivitamins & Supplements'],
                ['name' => 'Pediatric Care'],
            ],
        ],
        [
            'title' => 'Infection & Immunity',
            'items' => [['name' => 'Immune Support Products'], ['name' => 'Anti-inflammatory (Systemic)']],
        ],
        [
            'title' => 'Specialized Treatments',
            'items' => [
                ['name' => 'Anti-malarial'],
                ['name' => 'Anti-tuberculosis (if applicable)'],
                ['name' => 'Dermatology (Skin Treatments)'],
            ],
        ],
        [
            'title' => 'General Use & OTC',
            'items' => [['name' => 'General OTC Medicines'], ['name' => 'Nutritional & Health Supplements']],
        ],
    ];
@endphp

@section('content')
    <div class="mx-auto max-w-7xl" x-data="{
        view: 'categories',
        selectedCategory: '',
        selectedSub: '',
        selectedProduct: 'Product Item Detail Name'
    }">

        {{-- VIEW 1: HERO & CATEGORIES GRID --}}
        <div x-show="view === 'categories'" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95">
            {{-- HERO SECTION --}}
            <section
                class="relative overflow-hidden rounded-[45px] bg-gradient-to-br from-[#dff3ff] via-[#c7e7ff] to-[#b2d9ff] shadow-[0_20px_50px_rgba(30,76,161,0.15)] h-[620px] lg:h-[720px]">
                <div class="absolute inset-0 overflow-hidden rounded-[45px]">
                    <iframe width="100%" height="100%"
                        src="https://www.youtube.com/embed/mgR1Mwnram8?autoplay=1&loop=1&playlist=mgR1Mwnram8&mute=1&controls=0"
                        frameborder="0" allowfullscreen></iframe>
                    <div class="absolute inset-0 bg-black/40"></div>
                </div>

                <div class="relative z-20 grid items-center gap-8 px-8 py-12 lg:grid-cols-2 lg:px-14 lg:py-20 h-full">
                    <div class="max-w-2xl">
                        <h1 class="text-6xl font-black uppercase tracking-tight text-[#e31e24] sm:text-7xl lg:text-8xl">
                            PRODUCTS</h1>
                        <h2 class="mt-4 text-3xl font-bold leading-tight text-white sm:text-4xl lg:text-5xl">
                            Trusted Pharmaceutical Manufacturer in Cambodia
                        </h2>
                        <p class="mt-6 max-w-lg text-base leading-relaxed text-white/90">
                            High-quality healthcare solutions manufactured with international standards to ensure the
                            well-being of our community.
                        </p>
                        <div class="mt-10 flex flex-wrap gap-4">
                            <a href="#contact"
                                class="rounded-full bg-[#1452db] px-10 py-3.5 text-sm font-bold text-white hover:bg-[#0f3a9e] transition shadow-lg">Contact
                                Us</a>
                            <a href="#products-list"
                                class="rounded-full bg-white text-[#1452db] px-10 py-3.5 text-sm font-bold hover:bg-gray-100 transition">Explore
                                Products</a>
                        </div>
                    </div>
                </div>
            </section>

            {{-- GRID SECTION --}}
            <section id="products-list" class="py-24 bg-gradient-to-b from-[#eaf6ff] to-[#f4faff]">
                <div class="max-w-7xl mx-auto px-6">
                    <h2 class="text-4xl md:text-5xl text-center font-extrabold text-[#0a38a0] mb-20">Products</h2>
                    <div class="flex flex-wrap justify-center gap-5">
                        @foreach ($categories as $category)
                            <div
                                class="flex flex-col w-full sm:w-[calc(50%-20px)] lg:w-[calc(33.33%-20px)] xl:w-[calc(20%-20px)] bg-white/60 backdrop-blur-sm rounded-[32px] border border-blue-100/50 p-8 shadow-sm hover:shadow-md transition-all">
                                <h3 class="text-[#0a38a0] text-xl font-bold mb-8 leading-snug">{{ $category['title'] }}</h3>
                                <div class="flex flex-col gap-4">
                                    @foreach ($category['items'] as $item)
                                        <div @click="view = 'subcategory'; selectedCategory = '{{ $category['title'] }}'; selectedSub = '{{ $item['name'] }}'; window.scrollTo(0,0)"
                                            class="cursor-pointer transition-colors text-[14px] font-medium leading-tight {{ !empty($item['highlighted']) ? 'bg-[#0a38a0] text-white py-2 px-5 rounded-full inline-block text-center shadow-sm' : 'text-[#2d52a8] hover:text-[#1452db]' }}">
                                            {{ $item['name'] }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>

        {{-- VIEW 2: SUBCATEGORY PRODUCTS (Matches image_f24f4f.jpg) --}}
        <section x-show="view === 'subcategory'" x-cloak
            class="py-24 px-6 bg-gradient-to-b from-[#eaf6ff] to-white min-h-screen"
            x-transition:enter="transition ease-out duration-300">
            <div class="max-w-6xl mx-auto">
                <button @click="view = 'categories'; window.scrollTo(0,0)"
                    class="text-[#0a38a0] mb-12 flex items-center font-bold hover:underline">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Categories
                </button>

                <h1 class="text-5xl font-extrabold text-[#0a38a0] mb-4" x-text="selectedCategory"></h1>
                <h2 class="text-3xl font-bold text-[#0a38a0] mb-8" x-text="selectedSub"></h2>

                <p class="max-w-4xl text-gray-700 text-lg leading-relaxed mb-16">
                    Our <span x-text="selectedSub.toLowerCase()"></span> medicines are designed to effectively reduce
                    symptoms and promote recovery. Manufactured under strict quality standards, these products provide safe
                    and reliable solutions for health management.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10">
                    <template x-for="i in 4" :key="i">
                        <div class="flex flex-col">
                            <div class="w-full aspect-square bg-[#e2e8f0] rounded-[30px] mb-6 shadow-inner"></div>
                            <button @click="view = 'product-detail'; window.scrollTo(0,0)"
                                class="w-full py-4 rounded-full font-bold transition shadow-lg active:scale-95"
                                :class="i === 1 ? 'bg-[#0a38a0] text-white hover:bg-[#082d80]' :
                                    'bg-[#b6e3f8] text-[#0a38a0] hover:bg-[#a2d4ed]'">
                                View Detail
                            </button>
                        </div>
                    </template>
                </div>
            </div>
        </section>

        {{-- VIEW 3: PRODUCT DETAIL (Matches image_f1fd54.png) --}}
        <section x-show="view === 'product-detail'" x-cloak class="py-24 px-6 bg-white min-h-screen"
            x-transition:enter="transition ease-out duration-300">
            <div class="max-w-6xl mx-auto">
                <button @click="view = 'subcategory'; window.scrollTo(0,0)"
                    class="text-[#0a38a0] mb-12 flex items-center font-bold hover:underline">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to <span class="ml-1" x-text="selectedSub"></span>
                </button>

                <h2 class="text-4xl font-bold text-[#0a38a0] mb-16" x-text="selectedSub"></h2>

                <div class="grid md:grid-cols-2 gap-16 items-center">
                    {{-- Product Image Placeholder --}}
                    <div class="bg-[#e2e8f0] rounded-[40px] aspect-square w-full shadow-lg"></div>

                    <div class="flex flex-col items-start">
                        <h3 class="text-5xl font-extrabold text-[#0a38a0] mb-8" x-text="selectedProduct"></h3>
                        <p class="text-gray-600 text-lg mb-10 leading-relaxed">
                            This pharmaceutical solution is formulated for maximum efficacy and safety. Our manufacturing
                            process adheres to international GMP standards to ensure every batch meets the highest quality
                            expectations.
                        </p>

                        <ul class="space-y-5 mb-12 text-gray-800 font-medium">
                            <li class="flex items-center gap-3">
                                <span class="w-2 h-2 bg-black rounded-full"></span>
                                Manufactured under strict quality standards
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="w-2 h-2 bg-black rounded-full"></span>
                                These products provide safe and reliable solutions
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="w-2 h-2 bg-black rounded-full"></span>
                                For managing common health conditions effectively
                            </li>
                        </ul>

                        <button
                            class="bg-gradient-to-r from-[#0a38a0] to-[#1452db] text-white px-16 py-5 rounded-full font-bold text-xl shadow-[0_10px_30px_rgba(20,82,219,0.3)] hover:translate-y-[-2px] transition transform active:scale-95">
                            Order Now
                        </button>
                    </div>
                </div>
            </div>
        </section>

    </div>

    {{-- Inline CSS for x-cloak (prevents flickering on load) --}}
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    {{-- Ensure Alpine.js is included --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
