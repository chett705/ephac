@extends('Frontend.Layout.Main')

@section('content')
    @php
        // Fixed background for Quality Commitment
        $qualityBg = asset('storage/Screenshot 2026-05-08 115500.png');

        // Static Stats
        $stats = [
            ['value' => '150', 'label' => 'Products'],
            ['value' => '25', 'label' => 'Nationwide Distributors'],
            ['value' => '26', 'label' => 'Categories'],
            ['value' => '2', 'label' => 'Decades of Operation'],
            ['value' => '100+', 'label' => 'Employees'],
        ];

        // Fixed Why Choose Us Content
        $whyChoose = [
            [
                'num' => '01',
                'title' => 'Trusted Pharmaceutical Manufacturer',
                'desc' =>
                    'As one of Cambodia’s leading manufacturers, EPHAC has built a strong reputation for reliability.',
            ],
            [
                'num' => '02',
                'title' => 'Proven Quality & GMP Compliance',
                'desc' =>
                    'Our manufacturing processes follow ASEAN GMP standards and international quality requirements.',
            ],
            [
                'num' => '03',
                'title' => 'Wide Product Portfolio',
                'desc' => 'We produce over 150 products across 26 categories.',
            ],
            [
                'num' => '04',
                'title' => 'Advanced Manufacturing',
                'desc' => 'With modern facilities and continuous investment in pharmaceutical technology.',
            ],
            [
                'num' => '05',
                'title' => 'Strong Market Impact',
                'desc' => 'We actively support healthcare providers across Cambodia.',
            ],
            [
                'num' => '06',
                'title' => 'Experienced Team',
                'desc' => 'Our team of professionals brings strong technical expertise.',
            ],
        ];
    @endphp

    <section class="relative overflow-hidden bg-white">
        {{-- Decorative Background --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-24 -left-24 h-[600px] w-[600px] rounded-full bg-[#dbeafe] blur-3xl opacity-60"></div>
            <div class="absolute top-1/2 right-0 h-[700px] w-[700px] rounded-full bg-[#e0f2fe] blur-3xl opacity-50"></div>
        </div>

        <div class="relative mx-auto max-w-7xl">
            <div class="bg-gradient-to-br rounded-t-[40px] from-[#dff3ff] via-[#c7e7ff] to-[#b2d9ff]">
                {{-- HERO SECTION (Dynamic) --}}
                <section class="relative overflow-hidden rounded-[20px] bg-black h-[620px] lg:h-[720px] shadow-2xl">
                    <div class="absolute inset-0">
                        @if ($hero && $hero->video_url)
                            @php
                                // Extracts the ID even if the URL has query parameters like ?si=...
                                $urlPath = parse_url($hero->video_url, PHP_URL_PATH);
                                $videoId = basename($urlPath);

                                // Fallback for standard watch?v= format if the user pastes that instead
                                if ($hero->video_url && str_contains($hero->video_url, 'watch?v=')) {
                                    $videoId = Str::after($hero->video_url, 'v=');
                                    $videoId = Str::before($videoId, '&');
                                }
                            @endphp

                            <div class="w-full h-full pointer-events-none">
                                <iframe width="100%" height="100%"
                                    src="https://www.youtube.com/embed/{{ $videoId }}?autoplay=1&loop=1&playlist={{ $videoId }}&mute=1&controls=0&rel=0&showinfo=0&iv_load_policy=3"
                                    frameborder="0" allow="autoplay; encrypted-media"
                                    class="scale-[1.35] lg:scale-150 w-full h-full object-cover">
                                </iframe>
                            </div>
                        @endif
                        {{-- Dark Overlay to make text readable --}}
                        <div class="absolute inset-0 bg-black/50"></div>
                    </div>

                    <div class="relative z-20 flex items-center h-full px-8 lg:px-14">
                        <div class="max-w-3xl text-white">
                            {{-- Main Title --}}
                            <h1 class="text-6xl font-black uppercase tracking-tight text-[#e31e24] sm:text-7xl lg:text-8xl">
                                {{ $hero->title ?? 'Trusted Manufacturer' }}
                            </h1>

                            {{-- Dynamic Subtitle (Heading) --}}
                            <h2 class="mt-4 text-3xl font-bold leading-tight sm:text-4xl lg:text-5xl">
                                 {{ $hero->subtitle }}
                            </h2>

                            {{-- Dynamic Subtitle & Description --}}
                            <div class="mt-6 max-w-xl">
                                <p class="text-xl font-semibold text-white">
                                   
                                </p>
                                <p class="mt-2 text-lg text-white/80 leading-relaxed">
                                    {{ $hero->description }}
                                </p>    
                            </div>

                            {{-- Call to Action Buttons --}}
                            <div class="mt-10 flex flex-wrap gap-4">
                                <a href="/contact"
                                    class="rounded-full bg-[#1452db] px-10 py-3.5 text-sm font-bold text-white hover:bg-[#0f3a9e] transition-all duration-300 shadow-lg hover:scale-105">
                                    Contact Us
                                </a>

                                <a href="{{ route('Frontend.Pages.Product') }}#products-list"
                                    class="rounded-full bg-[#1452db] px-10 py-3.5 text-sm font-bold text-white hover:bg-[#0f3a9e] transition-all duration-300 shadow-lg hover:scale-105">
                                    Explore Products
                                </a>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- ABOUT (Dynamic) --}}
                <section class="py-24 text-center">
                    <h2 class="text-3xl font-bold text-[#1447b7] sm:text-4xl">{{ optional($about)->title ?? 'About Us' }}
                    </h2>
                    <div class="mt-8 max-w-4xl mx-auto space-y-6 text-[#42588e] leading-relaxed">
                        {!! nl2br(e(optional($about)->description ?? '')) !!}
                    </div>
                </section>

                {{-- STATS --}}
                <section class="pb-24">
                    <div class="grid grid-cols-2 gap-y-12 sm:grid-cols-3 lg:grid-cols-5">
                        @foreach ($stats as $stat)
                            {{-- Extract only numbers from the value (e.g., "100+" becomes 100) --}}
                            @php
                                $targetValue = (int) filter_var($stat['value'], FILTER_SANITIZE_NUMBER_INT);
                                $suffix = str_replace($targetValue, '', $stat['value']);
                            @endphp

                            <div class="flex flex-col items-center text-center px-4" x-data="{
                                current: 0,
                                target: {{ $targetValue }},
                                time: 2000,
                                startAnimation() {
                                    let start = null;
                                    const step = (timestamp) => {
                                        if (!start) start = timestamp;
                                        const progress = Math.min((timestamp - start) / this.time, 1);
                                        this.current = Math.floor(progress * this.target);
                                        if (progress < 1) {
                                            window.requestAnimationFrame(step);
                                        }
                                    };
                                    window.requestAnimationFrame(step);
                                }
                            }"
                                x-init="startAnimation()">

                                <span class="text-6xl font-light text-[#1447b7]">
                                    <span x-text="current">0</span>{{ $suffix }}
                                </span>

                                <span
                                    class="mt-3 text-[11px] font-bold uppercase tracking-[0.15em] text-[#e31e24] leading-tight max-w-[130px]">
                                    {{ $stat['label'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>


            {{-- PRODUCTS (Dynamic) --}}
            <section class="py-16">
                <div class="mx-auto max-w-7xl px-4">
                    <h2 class="text-center text-[#1447b7] text-3xl font-bold mb-20">Products Categorize</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-y-20 gap-x-8 mb-16">
                        @foreach ($categories as $category)
                            <div
                                class="group relative flex flex-col rounded-[24px] border border-blue-100 bg-gradient-to-b from-[#f0f9ff] to-[#e0f2fe] p-6 pt-24 shadow-sm hover:shadow-md transition-shadow h-full">
                                {{-- Floating Image --}}
                                <div class="absolute -top-12 left-1/2 -translate-x-1/2 w-full flex justify-center">
                                    <img src="{{ asset('uploads/categories/' . $category->image) }}"
                                        alt="{{ $category->name }}"
                                        class="h-32 w-auto object-contain drop-shadow-lg group-hover:scale-110 transition-transform duration-300">
                                </div>

                                {{-- Content --}}
                                <div class="text-left mt-2">
                                    <h4 class="text-xl font-bold text-[#1447b7] mb-3">{{ $category->name }}</h4>
                                    <p class="text-sm text-[#42588e] leading-relaxed">
                                        {{ Str::limit($category->description, 100) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Centered Explore More Button --}}
                    <div class="flex justify-center mt-12">
                        <a href="{{ route('Frontend.Pages.Product') }}#products-list"
                            class="px-12 py-3 bg-gradient-to-r from-[#0051ff] to-[#0036a3] text-white font-bold rounded-full shadow-lg hover:scale-105 transition-transform duration-200">
                            Explore More
                        </a>
                    </div>
                </div>
            </section>

            {{-- LEADERSHIP (Dynamic) --}}
            <section class="py-24 bg-white">
                <h2 class="text-center text-[#1447b7] text-3xl font-bold mb-16">Leadership Team</h2>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-8">
                    @foreach ($teams as $leader)
                        <div class="text-center">
                            <div
                                class="w-32 h-32 md:w-40 md:h-40 mx-auto rounded-full overflow-hidden border-4 border-white shadow-lg mb-4">
                                <img src="{{ asset('storage/' . $leader->image) }}" alt="{{ $leader->name }}"
                                    class="w-full h-full object-cover">
                            </div>
                            <h3 class="font-bold text-[#1447b7] text-sm">{{ $leader->name }}</h3>
                            <p class="text-[#e31e24] text-xs font-semibold">{{ $leader->position }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>

        {{-- WHY CHOOSE US (Fixed) --}}
        <section
            class="relative w-screen left-1/2 right-1/2 -mx-[50vw] py-24 bg-gradient-to-br from-[#0f4c9c] via-[#1e5bb8] to-[#1447b7]">
            <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl font-bold text-white mb-16">Why Choose Us</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($whyChoose as $item)
                        <div class="flex items-start gap-5 text-left">
                            <div class="text-5xl font-black text-[#e31e24]">{{ $item['num'] }}</div>
                            <div>
                                <h3 class="text-xl font-bold text-white">{{ $item['title'] }}</h3>
                                <p class="text-white/80 text-sm mt-2">{{ $item['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- CERTIFICATES SECTION (Dynamic) --}}
        <section class="py-24 bg-white">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold tracking-tight text-[#1447b7]">
                        Our Certificates
                    </h2>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 lg:gap-12">
                    @forelse ($certificates as $certificate)
                        <div class="group">
                            <div
                                class="aspect-[4/3] bg-gray-50 rounded-3xl overflow-hidden border border-gray-200 shadow-sm group-hover:shadow-xl transition-all duration-300">
                                <img src="{{ asset('storage/' . $certificate->image) }}" alt="{{ $certificate->title }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            </div>
                            <p class="text-center mt-5 font-semibold text-[#1447b7]">
                                {{ $certificate->title }}
                            </p>
                        </div>
                    @empty
                        <div class="col-span-full text-center text-gray-400">
                            No certificates available at the moment.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- QUALITY COMMITMENT (Fixed Layout) --}}
        <section class="relative w-screen left-1/2 right-1/2 -mx-[50vw] py-24 mb-18">
            <div class="absolute inset-0 bg-cover bg-center bg-[#0f4c9c]/90"
                style="background-image: url('{{ $qualityBg }}');">
                <div class="absolute inset-0 bg-[#0f4c9c]/75"></div>
            </div>
            <div class="relative z-10 mx-auto max-w-7xl px-8 grid lg:grid-cols-2 gap-12 items-center text-white">
                <div class="grid grid-cols-2 gap-4 max-w-[320px]">
                    <img src="{{ asset('storage/quality/quality-1.jpg') }}"
                        class="rounded-3xl shadow-2xl aspect-square object-cover">
                    <img src="{{ asset('storage/quality/quality-2.jpg') }}"
                        class="rounded-3xl shadow-2xl aspect-square object-cover mt-12">
                    <img src="{{ asset('storage/quality/quality-3.jpg') }}"
                        class="rounded-3xl shadow-2xl aspect-square object-cover">
                </div>
                <div>
                    <h2 class="text-4xl sm:text-5xl font-bold mb-8">Quality Commitment</h2>
                    <ul class="space-y-4 text-lg">
                        <li>• Strict quality control</li>
                        <li>• High safety & efficacy standards</li>
                        <li>• Continuous technology investment</li>
                    </ul>
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
    </section>
@endsection
