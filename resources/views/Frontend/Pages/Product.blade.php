@extends('Frontend.Layout.Main')

@php
    $productTree = $productCategories
        ->map(function ($category) {
            return [
                'id' => $category->id,
                'title' => $category->title,
                'subcategories' => $category->subcategories
                    ->map(function ($subcategory) {
                        return [
                            'id' => $subcategory->id,
                            'name' => $subcategory->name,
                            'desc' => $subcategory->desc, // ENSURE THIS LINE IS HERE
                            'highlighted' => (bool) $subcategory->highlighted,
                            'products' => $subcategory->products
                                ->map(function ($product) {
                                    return [
                                        'id' => $product->id,
                                        'name' => $product->name,
                                        'image' => $product->image ? asset('storage/' . $product->image) : null,
                                        'description' => $product->description,
                                        'benefits' => collect(preg_split('/\r\n|\r|\n/', (string) $product->benefits))
                                            ->map(fn($benefit) => trim($benefit))
                                            ->filter()
                                            ->values()
                                            ->all(),
                                        'button_text' => $product->button_text ?: 'Order Now',
                                    ];
                                })
                                ->values()
                                ->all(),
                        ];
                    })
                    ->values()
                    ->all(),
            ];
        })
        ->values()
        ->all();
@endphp

@section('content')
    <div x-data="productPage(@js($productTree))" x-cloak>

        {{-- View: Categories --}}
        <div x-show="view === 'categories'" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-95">
            <div class="bg-gradient-to-br from-[#dff3ff] via-[#c7e7ff] to-[#b2d9ff] rounded-t-[40px]">
                <section class="relative overflow-hidden rounded-[20px] bg-black h-[620px] lg:h-[720px] shadow-2xl">
                    <div class="absolute inset-0">
                        @if ($hero && $hero->video_url)
                            @php $videoId = Str::afterLast($hero->video_url, '/'); @endphp
                            <iframe width="100%" height="100%"
                                src="https://www.youtube.com/embed/{{ $videoId }}?autoplay=1&loop=1&playlist={{ $videoId }}&mute=1&controls=0"
                                frameborder="0" allowfullscreen class="scale-150"></iframe>
                        @endif
                        <div class="absolute inset-0 bg-black/40"></div>
                    </div>
                    <div class="relative z-20 flex items-center h-full px-8 lg:px-14">
                        <div class="max-w-2xl text-white">
                            <h1 class="text-6xl font-black uppercase tracking-tight text-[#e31e24] sm:text-7xl lg:text-8xl">
                                EPHAC</h1>
                            <h2 class="mt-4 text-3xl font-bold leading-tight sm:text-4xl lg:text-5xl">
                                {{ optional($hero)->title ?? 'Trusted Manufacturer' }}</h2>
                            <p class="mt-6 max-w-lg text-lg text-white/90">
                                {{ optional($hero)->subtitle }}
                                {{ optional($hero)->description }}
                            </p>

                            <div class="mt-10 flex flex-wrap gap-4">
                                <a href="#contact"
                                    class="rounded-full bg-[#1452db] px-10 py-3.5 text-sm font-bold text-white hover:bg-[#0f3a9e] transition">
                                    Contact Us
                                </a>

                                <a href="{{ route('Frontend.Pages.Product') }}#products-list"
                                    class="rounded-full bg-[#1452db] px-10 py-3.5 text-sm font-bold text-white hover:bg-[#0f3a9e] transition">
                                    Explore Products
                                </a>
                            </div>
                        </div>

                    </div>
                </section>

                {{-- Categories Grid --}}
                <section id="products-list" class="py-24 px-6">
                    <div class="max-w-7xl mx-auto">
                        <h2 class="text-2xl md:text-3xl text-center font-extrabold text-[#0a38a0] mb-20">Products</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
                            <template x-for="category in categories" :key="category.id">
                                <div
                                    class="flex flex-col bg-white/70 backdrop-blur-md rounded-[32px] border border-white/50 p-4 shadow-xl hover:shadow-2xl transition-all duration-300">
                                    <h3 class="text-[#0a38a0] text-xl font-black mb-6 border-b border-blue-100 pb-4 h-14 overflow-hidden"
                                        x-text="category.title"></h3>
                                    <div class="flex flex-col gap-3">
                                        <template x-for="subcategory in category.subcategories" :key="subcategory.id">
                                            <button type="button" @click="openSubcategory(category, subcategory)"
                                                class="transition-all text-[11px] font-bold text-left py-2 px-4 rounded-xl group hover:bg-[#0a38a0] hover:text-white">
                                                <span x-text="subcategory.name "></span>
                                            </button>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        {{-- View: Subcategory Products --}}
        <section x-show="view === 'subcategory'" class="py-24 px-6 min-h-screen bg-gray-50"
            x-transition:enter="transition ease-out duration-300">
            <div class="max-w-7xl mx-auto">
                <button @click="backToCategories()"
                    class="text-[#0a38a0] mb-12 flex items-center font-bold  transition-all">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Categories
                </button>
                <h1 class="text-[50px] font-black text-[#0a38a0] mb-2" x-text="selectedCategory?.title"></h1>
                <h2 class="text-[30px] font-bold text-gray-500 mb-6" x-text="selectedSubcategory?.name"></h2>

                {{-- SUBCATEGORY DESCRIPTION FIXED --}}
                <div class="max-w-4xl mb-12">
                    <p class="text-[20px] text-gray-700 leading-relaxed"
                        x-text="selectedSubcategory?.desc || 'Quality pharmaceutical solutions manufactured under strict standards.'">
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-8">
                    <template x-for="product in selectedSubcategory?.products || []" :key="product.id">
                        <div class="bg-white rounded-[30px] p-6 shadow-lg hover:shadow-2xl transition-all group">
                            <div class="aspect-square bg-gray-100 rounded-[20px] mb-6 overflow-hidden">
                                <img :src="product.image"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <h4 class="text-[14px] font-bold text-[#0a38a0] mb-6 h-14 line-clamp-2" x-text="product.name"></h4>
                            <button @click="openProduct(product)"
                                class="w-full py-2   rounded-full  bg-[#0a38a0] text-white hover:brightness-110 hover:scale-105 
                            active:scale-95 transition-all  shadow-lg duration-300">View
                                Details</button>
                        </div>
                    </template>
                </div>
            </div>
        </section>

        {{-- View: Product Detail --}}
        <section x-show="view === 'product-detail'" class="py-24 px-6 min-h-screen bg-white"
            x-transition:enter="transition ease-out duration-300">
            <div class="max-w-4xl mx-auto">
                <button @click="backToSubcategory()"
                    class="text-[#0a38a0] mb-12 flex items-center font-bold hover:gap-2 transition-all">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to <span class="ml-1" x-text="selectedSubcategory?.name"></span>
                </button>

                <div class="flex flex-col lg:flex-row gap-16 items-start">
                    <div class="w-full lg:w-1/3 lg:sticky lg:top-32">
                        <div
                            class="bg-gray-50 rounded-[40px] aspect-square shadow-2xl overflow-hidden border-8 border-white group">
                            <template x-if="selectedProduct?.image">
                                <img :src="selectedProduct.image" :alt="selectedProduct.name"
                                    class="w-full h-full object-contain p-12 transition-transform duration-700 group-hover:scale-105">
                            </template>
                        </div>
                    </div>

                    <div class="w-full lg:w-2/3">
                        <span class="text-[#e31e24] font-black tracking-widest uppercase text-sm"
                            x-text="selectedSubcategory?.name"></span>
                        <h3 class="text-2xl lg:text-3xl font-black text-[#0a38a0] mt-2 mb-8 leading-tight"
                            x-text="selectedProduct?.name"></h3>

                        <div class="prose prose-xl text-gray-600 mb-12 leading-relaxed">
                            <p x-text="selectedProduct?.description"></p>
                        </div>

                        <div class="space-y-6 mb-16" x-show="selectedProduct?.benefits.length">

                            <template x-for="(benefit, index) in selectedProduct?.benefits || []" :key="index">
                                <div class="flex items-start gap-5">

                                    <!-- Bullet (thin line) -->
                                    <div class="w-2 h-2 bg-[#000000] rounded-full flex-shrink-0 mt-1.5"></div>

                                    <!-- Benefit Text -->
                                    <span class="font-semibold text-[20px] leading-tight tracking-[-0.02em] text-[#000000   ]"
                                        x-text="benefit">
                                    </span>

                                </div>
                            </template>

                        </div>

                        <button
                            class="bg-gradient-to-r from-[#0A38A0] to-[#004EFF] text-white px-7 py-4 rounded-full font-black text-xl shadow-2xl 
                            hover:brightness-110 hover:scale-105 
                            active:scale-95 transition-all duration-300">
                            <span x-text="selectedProduct?.button_text"></span>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        {{-- TRUSTED BANNER (Fixed) --}}
        <section class="relative w-screen left-1/2 right-1/2 -mx-[50vw] h-[300px] flex items-center justify-center">
            <div class="absolute inset-0 bg-cover bg-center opacity-50"
                style="background-image: url('{{ asset('storage/backgrounds/pharma-hands-bg.jpg') }}');"></div>
            <div class="absolute inset-0 bg-[#0a2a5e]/80"></div>
            <h2 class="relative z-10 text-4xl font-bold text-white text-center">
                Trusted Pharmaceutical Manufacturer in <br>
                <span>Cambodia</span>
            </h2>
        </section>
    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }

        html {
            scroll-behavior: smooth;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <script>
        function productPage(categories) {
            return {
                categories,
                view: 'categories',
                selectedCategory: null,
                selectedSubcategory: null,
                selectedProduct: null,
                openSubcategory(category, subcategory) {
                    this.selectedCategory = category;
                    this.selectedSubcategory = subcategory;
                    this.view = 'subcategory';
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                },
                openProduct(product) {
                    this.selectedProduct = product;
                    this.view = 'product-detail';
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                },
                backToCategories() {
                    this.view = 'categories';
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                },
                backToSubcategory() {
                    this.view = 'subcategory';
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                }
            };
        }
    </script>
@endsection
