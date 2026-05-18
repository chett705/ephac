@extends('Frontend.Layout.Main')

@section('content')
    <div class="relative mx-auto max-w-7xl">

        {{-- HERO --}}
        <div class ="bg-gradient-to-br rounded-t-[40px] from-[#dff3ff] via-[#c7e7ff] to-[#b2d9ff]">
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
                            <a href="#contact"
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

            {{-- VISION & MISSION + STRENGTHS --}}
            <section class="relative overflow-hidden  py-16 ">
                <div class="max-w-7xl mx-auto px-6">

                    <!-- Vision & Mission Cards -->
                    <div class="grid md:grid-cols-2 gap-8 mb-16">

                        <!-- Vision -->
                        <div class="bg-[#96E1FF] rounded-3xl p-8 text-[#1e3a8a] shadow-xl">
                            <h2 class="text-3xl font-bold mb-6">Our Vision</h2>
                            <p class="text-lg leading-relaxed">
                                Our vision is to become a trusted leader in the pharmaceutical industry by
                                improving the quality of life for communities and driving sustainable growth
                                across Cambodia and international markets.
                            </p>
                        </div>

                        <!-- Mission -->
                        <div class="bg-[#1e40af] rounded-3xl p-8 text-white shadow-xl">
                            <h2 class="text-3xl font-bold mb-6">Our Mission</h2>
                            <p class="text-lg leading-relaxed">
                                Our mission is to enhance community health and well-being by delivering safe,
                                effective, and affordable pharmaceutical products, and by supporting improved
                                patient outcomes.
                            </p>
                        </div>

                    </div>

                    <!-- Strengths -->
                    <div class="text-center mb-12">
                        <h2 class="text-4xl font-bold text-[#1e3a8a]">Our Strengths</h2>
                    </div>

                    <div class="grid md:grid-cols-4 gap-8">
                        <!-- 01 -->
                        <div class="text-center group">
                            <div
                                class="mx-auto w-16 h-16 flex items-center justify-center text-4xl font-bold text-red-600   duration-300">
                                01
                            </div>
                            <h3 class="mt-6 font-semibold text-lg text-[#1e3a8a]">
                                State-of-the-art production facilities
                            </h3>
                        </div>

                        <!-- 02 -->
                        <div class="text-center group">
                            <div
                                class="mx-auto w-16 h-16 flex items-center justify-center  text-4xl font-bold text-red-600   duration-300">
                                02
                            </div>
                            <h3 class="mt-6 font-semibold text-lg text-[#1e3a8a]">
                                Certified compliance with ASEAN GMP and global quality standards
                            </h3>
                        </div>

                        <!-- 03 -->
                        <div class="text-center group">
                            <div
                                class="mx-auto w-16 h-16 flex items-center justify-center text-4xl font-bold text-red-600  duration-300">
                                03
                            </div>
                            <h3 class="mt-6 font-semibold text-lg text-[#1e3a8a]">
                                Dedicated team of experienced professionals
                            </h3>
                        </div>

                        <!-- 04 -->
                        <div class="text-center group">
                            <div
                                class="mx-auto w-16 h-16 flex items-center justify-center text-4xl font-bold text-red-600  duration-300">
                                04
                            </div>
                            <h3 class="mt-6 font-semibold text-lg text-[#1e3a8a]">
                                Continuous focus on innovation and operational excellence
                            </h3>
                        </div>
                    </div>

                </div>
            </section>
        </div>


        <div class="bg-white font-sans text-[#222]">

            <section class="bg-white py-16 px-6 overflow-hidden">
                <div class="max-w-6xl mx-auto">
                    <h2 class="text-center text-[#0B1F66] text-4xl md:text-5xl font-bold mb-20">
                        Our Journey & Milestones
                    </h2>

                    <div class="space-y-16 md:space-y-24">
                        {{-- ROW 1: 2003 - 2015 --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-y-12">
                            @foreach ([2003, 2005, 2010, 2015] as $year)
                                <div class="flex flex-col items-center">
                                    <div class="flex items-center justify-center w-full mb-4">
                                        {{-- Line Left (Hidden on first item of the row) --}}
                                        <div
                                            class="hidden lg:block h-[2px] flex-1 bg-[#1452db] {{ $loop->first ? 'invisible' : '' }}">
                                        </div>

                                        <span class="text-[#e31e24] text-4xl font-medium px-4">{{ $year }}</span>

                                        {{-- Line Right (Hidden on last item of the row) --}}
                                        <div
                                            class="hidden lg:block h-[2px] flex-1 bg-[#1452db] {{ $loop->last ? 'invisible' : '' }}">
                                        </div>
                                    </div>
                                    <p class="text-center text-sm text-gray-700 max-w-[200px] leading-relaxed">
                                        Lorem Certified compliance with ASEAN GMP and global quality standards
                                    </p>
                                </div>
                            @endforeach
                        </div>

                        {{-- ROW 2: 2020 - 2025 (Centered) --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-y-12">
                            {{-- Empty Spacer for Desktop to center the 2 items --}}
                            <div class="hidden lg:block"></div>

                            @foreach ([2020, 2025] as $year)
                                <div class="flex flex-col items-center">
                                    <div class="flex items-center justify-center w-full mb-4">
                                        {{-- Line Left --}}
                                        <div
                                            class="hidden lg:block h-[2px] flex-1 bg-[#1452db] {{ $loop->first ? 'invisible' : '' }}">
                                        </div>

                                        <span class="text-[#e31e24] text-4xl font-medium px-4">{{ $year }}</span>

                                        {{-- Line Right --}}
                                        <div
                                            class="hidden lg:block h-[2px] flex-1 bg-[#1452db] {{ $loop->last ? 'invisible' : '' }}">
                                        </div>
                                    </div>
                                    <p class="text-center text-sm text-gray-700 max-w-[200px] leading-relaxed">
                                        Lorem Certified compliance with ASEAN GMP and global quality standards
                                    </p>
                                </div>
                            @endforeach

                            {{-- Empty Spacer for Desktop --}}
                            <div class="hidden lg:block"></div>
                        </div>
                    </div>
                </div>
            </section>



            {{-- Trusted --}}
            <section
                class="relative w-screen left-1/2 right-1/2 -mx-[50vw] h-[300px] flex items-center justify-center overflow-hidden">

                <!-- Background Image -->
                <div class="absolute inset-0 bg-cover bg-center bg-no-repeat">
                </div>

                <!-- Dark Blue Overlay -->
                <div class="absolute inset-0 bg-gradient-to-r from-[#0a2a5e]/80 via-[#1e4a8a]/70 to-[#0a2a5e]/80"></div>

                <!-- Content -->
                <div class="relative z-10 text-center px-6 max-w-4xl mx-auto">
                    <h2
                        class="text-4xl md:text-4xl lg:text-4xl font-bold text-white leading-tight tracking-tight drop-shadow-2xl">
                        Trusted Pharmaceutical Manufacturer in <br>
                        <span>Cambodia</span>
                    </h2>
                </div>

            </section>

        </div>
    @endsection
