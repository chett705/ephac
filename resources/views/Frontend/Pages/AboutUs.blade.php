@extends('Frontend.Layout.Main')

@section('content')

<div class="relative mx-auto max-w-7xl">

    {{-- HERO --}}
    <section class="relative overflow-hidden rounded-[45px] bg-gradient-to-br from-[#dff3ff] via-[#c7e7ff] to-[#b2d9ff] shadow-[0_20px_50px_rgba(30,76,161,0.15)] h-[620px] lg:h-[720px]">

        <div class="absolute inset-0 overflow-hidden rounded-[45px]">
            <iframe
                width="100%"
                height="100%"
                src="https://www.youtube.com/embed/mgR1Mwnram8?autoplay=1&loop=1&playlist=mgR1Mwnram8&mute=1&controls=0"
                frameborder="0"
                allowfullscreen>
            </iframe>

            <div class="absolute inset-0 bg-black/40"></div>
        </div>

        <div class="relative z-20 grid items-center gap-8 px-8 py-12 lg:grid-cols-2 lg:px-14 lg:py-20 h-full">

            <div class="max-w-2xl">
                <h1 class="text-6xl font-black uppercase tracking-tight text-[#e31e24] sm:text-7xl lg:text-8xl">
                    EPHAC
                </h1>

                <h2 class="mt-4 text-3xl font-bold leading-tight text-white sm:text-4xl lg:text-5xl">
                    Trusted Pharmaceutical Manufacturer in Cambodia
                </h2>

                <p class="mt-6 max-w-lg text-base leading-relaxed text-white/90">
                    consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                </p>

                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="#contact"
                        class="rounded-full bg-[#1452db] px-10 py-3.5 text-sm font-bold text-white hover:bg-[#0f3a9e] transition">
                        Contact Us
                    </a>

                    <a href="#products"
                        class="rounded-full bg-white text-[#1452db] px-10 py-3.5 text-sm font-bold hover:bg-gray-100 transition">
                        Explore Products
                    </a>
                </div>
            </div>

        </div>
    </section>

    {{-- VISION & MISSION + STRENGTHS --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-[#dff3ff] via-[#c7e7ff] to-[#b2d9ff] py-16">
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
                    <div class="mx-auto w-16 h-16 flex items-center justify-center text-4xl font-bold text-red-600   duration-300">
                        01
                    </div>
                    <h3 class="mt-6 font-semibold text-lg text-[#1e3a8a]">
                        State-of-the-art production facilities
                    </h3>
                </div>

                <!-- 02 -->
                <div class="text-center group">
                    <div class="mx-auto w-16 h-16 flex items-center justify-center  text-4xl font-bold text-red-600   duration-300">
                        02
                    </div>
                    <h3 class="mt-6 font-semibold text-lg text-[#1e3a8a]">
                        Certified compliance with ASEAN GMP and global quality standards
                    </h3>
                </div>

                <!-- 03 -->
                <div class="text-center group">
                    <div class="mx-auto w-16 h-16 flex items-center justify-center text-4xl font-bold text-red-600  duration-300">
                        03
                    </div>
                    <h3 class="mt-6 font-semibold text-lg text-[#1e3a8a]">
                        Dedicated team of experienced professionals
                    </h3>
                </div>

                <!-- 04 -->
                <div class="text-center group">
                    <div class="mx-auto w-16 h-16 flex items-center justify-center text-4xl font-bold text-red-600  duration-300">
                        04
                    </div>
                    <h3 class="mt-6 font-semibold text-lg text-[#1e3a8a]">
                        Continuous focus on innovation and operational excellence
                    </h3>
                </div>
            </div>

        </div>
    </section>

    <div class="bg-white font-sans text-[#222]">

        <section class="bg-[#f3f3f3] py-20 px-6">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-center text-[#0B1F66] text-4xl md:text-5xl font-bold mb-20">
                    Our Journey & Milestones
                </h2>

                <div class="flex flex-wrap justify-center items-start gap-y-12 mb-20">
                    @foreach([2020, 2025, 2025, 2025] as $year)
                    <div class="flex-1 min-w-[200px] text-center group">
                        <div class="flex items-center justify-center mb-6">
                            <span class="text-red-500 text-5xl font-light px-4">{{ $year }}</span>
                            @if(!$loop->last)
                            <div class="hidden md:block h-[1px] flex-1 bg-blue-700/30"></div>
                            @endif
                        </div>
                        <p class="text-sm leading-relaxed px-4">
                            Lorem Certified<br>compliance with ASEAN<br>GMP and global quality<br>standards
                        </p>
                    </div>
                    @endforeach
                </div>

                <div class="flex flex-wrap justify-center items-start gap-y-12 ">
                    @foreach([2020, 2025] as $year)
                    <div class="w-full md:w-1/3 text-center">
                        <div class="flex items-center justify-center mb-6">
                            @if($loop->last) <div class="hidden md:block h-[1px] w-70 bg-blue-700"></div> @endif
                            <span class="text-red-500 text-5xl font-light px-4">{{ $year }}</span>
                            @if($loop->first) <div class="hidden md:block h-[1px] w-66 bg-blue-700"></div> @endif
                        </div>
                        <p class="text-sm leading-relaxed">
                            Lorem Certified<br>compliance with ASEAN<br>GMP and global quality<br>standards
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>



        {{-- Trusted --}}
        <section class="relative w-screen left-1/2 right-1/2 -mx-[50vw] h-[300px] flex items-center justify-center overflow-hidden">

            <!-- Background Image -->
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat">
            </div>

            <!-- Dark Blue Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-[#0a2a5e]/80 via-[#1e4a8a]/70 to-[#0a2a5e]/80"></div>

            <!-- Content -->
            <div class="relative z-10 text-center px-6 max-w-4xl mx-auto">
                <h2 class="text-4xl md:text-4xl lg:text-4xl font-bold text-white leading-tight tracking-tight drop-shadow-2xl">
                    Trusted Pharmaceutical Manufacturer in <br>
                    <span>Cambodia</span>
                </h2>
            </div>

        </section>

    </div>


    @endsection