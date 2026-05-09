@extends('Frontend.Layout.Main')

@section('content')
    @php
        $qualityBg = asset('storage/Screenshot 2026-05-08 115500.png');

        $stats = [
            ['value' => '150', 'label' => 'Products'],
            ['value' => '25', 'label' => 'Nationwide Distributors'],
            ['value' => '26', 'label' => 'Categories'],
            ['value' => '02', 'label' => 'Decades of Business Operation'],
            ['value' => '100+', 'label' => 'Employees'],
        ];

        $categories = [
            [
                'name' => 'Tablets',
                'image' => asset('storage/tablets.png'),
                'desc' =>
                    'consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.',
            ],
            [
                'name' => 'Capsules',
                'image' => asset('storage/dd2fdc2c22e5e1413d2c11a64e108657456efc0f.png'),
                'desc' =>
                    'consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.',
            ],
            [
                'name' => 'Syrups',
                'image' => asset('storage/a3366649237d0217d3a14d85a95470c46f9f3717.png'),
                'desc' =>
                    'consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.',
            ],
            [
                'name' => 'Injections',
                'image' => asset('storage/50e0e67d5062d232f1f90b1e3edec1a6b2eaab31.png'),
                'desc' =>
                    'consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.',
            ],
            [
                'name' => 'Supplements',
                'image' => asset('storage/e7d9a10953ed8362e0d3669d3957d27e0a4501eb.png'),
                'desc' =>
                    'consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.',
            ],
        ];

        $leadership = [
            [
                'name' => 'Mr. Kao Muylim',
                'position' => 'Founder & CEO',
                'image' => asset('storage/team/kao-muylim.jpg'),
            ],
            [
                'name' => 'Dr. Srey Channary',
                'position' => 'Chief Pharmacist',
                'image' => asset('storage/team/srey-channary.jpg'),
            ],
            [
                'name' => 'Mr. Lim Vuthy',
                'position' => 'Operations Director',
                'image' => asset('storage/team/lim-vuthy.jpg'),
            ],
            [
                'name' => 'Ms. Chan Sopheak',
                'position' => 'Finance & Administration Director',
                'image' => asset('storage/team/chan-sopheak.jpg'),
            ],
            [
                'name' => 'Dr. Heng Borey',
                'position' => 'Technical & R&D Director',
                'image' => asset('storage/team/heng-borey.jpg'),
            ],
        ];

        $whyChoose = [
            [
                'num' => '01',
                'title' => 'Trusted Pharmaceutical Manufacturer',
                'desc' =>
                    'As one of Cambodia’s leading and most comprehensive pharmaceutical manufacturers, EPHAC has built a strong reputation for reliability, consistency, and long-term partnerships.',
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
                'title' => 'Advanced Manufacturing Capabilities',
                'desc' => 'With modern facilities and continuous investment in pharmaceutical technology.',
            ],
            [
                'num' => '05',
                'title' => 'Strong Market Impact & Trust',
                'desc' => 'We actively support healthcare providers across Cambodia.',
            ],
            [
                'num' => '06',
                'title' => 'Experienced & Skilled Team',
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

            {{-- HERO --}}
            <section
                class=" relative overflow-hidden rounded-[45px] bg-gradient-to-br from-[#dff3ff] via-[#c7e7ff] to-[#b2d9ff] shadow-[0_20px_50px_rgba(30,76,161,0.15)] h-[620px] lg:h-[720px]">

                <div class="absolute inset-0 overflow-hidden rounded-[45px]">
                    <iframe width="100%" height="100%"
                        src="https://www.youtube.com/embed/mgR1Mwnram8?autoplay=1&loop=1&playlist=mgR1Mwnram8&mute=1&controls=0"
                        frameborder="0" allowfullscreen>
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
                            consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna
                            aliquam erat volutpat.
                        </p>

                        <div class="mt-10 flex flex-wrap gap-4">
                            <a href="#contact" class="rounded-full bg-[#1452db] px-10 py-3.5 text-sm font-bold text-white">
                                Contact Us
                            </a>

                            <a href="#products" class="rounded-full bg-white text-[#1452db] px-10 py-3.5 text-sm font-bold">
                                Explore Products
                            </a>
                        </div>
                    </div>

                </div>
            </section>

            {{-- ABOUT --}}
            <section class="py-24">
                <div class="mx-auto max-w-4xl text-center">

                    <h2 class="text-3xl font-bold tracking-tight text-[#1447b7] sm:text-4xl">
                        About Us
                    </h2>

                    <div class="mt-8 space-y-6 text-sm leading-8 text-[#42588e] sm:text-base md:px-10">
                        <p>
                            Established in 2003 by Mr. Kao Muylim, our company is dedicated to providing safe, effective,
                            and affordable medicines.
                        </p>

                        <p>
                            Today, we produce approximately 150 products across 26 categories nationwide.
                        </p>
                    </div>

                </div>
            </section>

          
            {{-- STATS SECTION --}}
            <section class="pb-24">
                <div class="grid grid-cols-2 gap-y-12 sm:grid-cols-3 lg:grid-cols-5">
                    @foreach ($stats as $stat)
                        <div class="flex flex-col items-center text-center px-4" x-data="{
                            current: 0,
                            target: {{ (int) filter_var($stat['value'], FILTER_SANITIZE_NUMBER_INT) }},
                            time: 2000
                        }"
                            x-init="let start = null;
                            const step = (timestamp) => {
                                if (!start) start = timestamp;
                                const progress = Math.min((timestamp - start) / time, 1);
                                current = Math.floor(progress * target);
                                if (progress < 1) {
                                    window.requestAnimationFrame(step);
                                }
                            };
                            window.requestAnimationFrame(step);">
                            <span class="text-6xl font-light text-[#1447b7] sm:text-7xl">
                                <span x-text="current">0</span>{{ str_contains($stat['value'], '+') ? '+' : '' }}
                            </span>
                            <span
                                class="mt-3 text-[11px] font-bold uppercase tracking-[0.15em] text-[#e31e24] leading-tight max-w-[130px]">
                                {{ $stat['label'] }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- PRODUCTS --}}
            <section class="py-16">

                <div class="mx-auto max-w-4xl text-center mb-16">
                    <h2 class="text-3xl font-bold tracking-tight text-[#1447b7] sm:text-4xl">
                        Products Categorize
                    </h2>
                </div>

                <div class="mx-auto max-w-7xl grid grid-cols-1 gap-16 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">

                    @foreach ($categories as $category)
                        <div
                            class="group relative flex flex-col rounded-[24px] border border-blue-100 bg-gradient-to-b from-[#f0f9ff] to-[#e0f2fe] p-6 pt-20">

                            <div class="absolute -top-12 left-1/2 -translate-x-1/2 w-full flex justify-center">
                                <img src="{{ $category['image'] }}" alt="{{ $category['name'] }}"
                                    class="h-32 w-auto object-contain">
                            </div>

                            <div class="mt-4 text-left">
                                <h4 class="text-xl font-bold text-[#1447b7] mb-3">
                                    {{ $category['name'] }}
                                </h4>

                                <p class="text-sm leading-relaxed text-[#42588e]">
                                    {{ $category['desc'] }}
                                </p>
                            </div>

                        </div>
                    @endforeach

                </div>

            </section>
            <section class="py-24 bg-white">
                <div class="max-w-5xl mx-auto px-6">
                    <h2 class="text-center text-[#1447b7] text-3xl font-bold mb-20">Leadership Team</h2>

                    <div class="relative">
                        <div class="flex justify-between md:justify-around items-center mb-4 md:mb-0">
                            <div class="w-24 h-24 md:w-44 md:h-44 rounded-full bg-gray-200 shadow-inner"></div>
                            <div class="w-24 h-24 md:w-44 md:h-44 rounded-full bg-gray-200 shadow-inner"></div>
                            <div class="w-24 h-24 md:w-44 md:h-44 rounded-full bg-gray-200 shadow-inner"></div>
                        </div>

                        <div class="flex justify-center gap-12 md:gap-48 -mt-6 md:-mt-16">
                            <div
                                class="w-24 h-24 md:w-44 md:h-44 rounded-full bg-gray-200 shadow-inner border-4 border-white">
                            </div>
                            <div
                                class="w-24 h-24 md:w-44 md:h-44 rounded-full bg-gray-200 shadow-inner border-4 border-white">
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>

        {{-- WHY CHOOSE US FULL WIDTH --}}
        <section class="relative w-screen left-1/2 right-1/2 -mx-[50vw] py-24 overflow-hidden">

            <div class="absolute inset-0 bg-gradient-to-br from-[#0f4c9c] via-[#1e5bb8] to-[#1447b7]"></div>

            <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold tracking-tight text-white">
                        Why Choose Us
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                    @foreach ($whyChoose as $item)
                        <div class="group">

                            <div class="flex items-start gap-5">

                                <div class="text-5xl font-black text-[#e31e24] leading-none">
                                    {{ $item['num'] }}
                                </div>

                                <div>
                                    <h3 class="text-xl font-bold text-white mb-3 leading-tight">
                                        {{ $item['title'] }}
                                    </h3>

                                    <p class="text-white/80 text-[15px] leading-relaxed">
                                        {{ $item['desc'] }}
                                    </p>
                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>

            </div>

        </section>


        {{-- CERTIFICATES SECTION --}}
        <section class="py-24 bg-white">

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold tracking-tight text-[#1447b7]">
                        Certificates
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12">

                    {{-- GMP --}}
                    <div class="group">

                        <div
                            class="aspect-[4/3] bg-gray-100 rounded-3xl overflow-hidden border border-gray-200 shadow-sm group-hover:shadow-xl transition-all duration-300">

                            <img src="{{ asset('storage/certificates/gmp.jpg') }}" alt="GMP Certification"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                        </div>

                        <p class="text-center mt-5 font-semibold text-[#1447b7]">
                            GMP Certification
                        </p>

                    </div>

                    {{-- Business Registration --}}
                    <div class="group">

                        <div
                            class="aspect-[4/3] bg-gray-100 rounded-3xl overflow-hidden border border-gray-200 shadow-sm group-hover:shadow-xl transition-all duration-300">

                            <img src="{{ asset('storage/certificates/business-registration.jpg') }}"
                                alt="Business Registration"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                        </div>

                        <p class="text-center mt-5 font-semibold text-[#1447b7]">
                            Business Registration Certificates
                        </p>

                    </div>

                    {{-- Other --}}
                    <div class="group">

                        <div
                            class="aspect-[4/3] bg-gray-100 rounded-3xl overflow-hidden border border-gray-200 shadow-sm group-hover:shadow-xl transition-all duration-300">

                            <img src="{{ asset('storage/certificates/other.jpg') }}" alt="Other Certificates"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                        </div>

                        <p class="text-center mt-5 font-semibold text-[#1447b7]">
                            Other Certificates
                        </p>

                    </div>

                </div>

            </div>

        </section>

        {{-- QUALITY COMMITMENT FULL WIDTH --}}
        <section class="relative w-screen left-1/2 right-1/2 -mx-[50vw] py-20 overflow-hidden mb-18">

            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                style="background-image: url('{{ $qualityBg }}');">

                <div class="absolute inset-0 bg-[#0f4c9c]/75"></div>
            </div>

            <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="grid lg:grid-cols-2 gap-12 items-center">

                    {{-- LEFT --}}
                    <div class="relative flex justify-center lg:justify-end">

                        <div class="grid grid-cols-2 gap-4 w-full max-w-[320px]">

                            <img src="{{ asset('storage/quality/quality-1.jpg') }}"
                                class="rounded-3xl shadow-2xl aspect-square object-cover">

                            <img src="{{ asset('storage/quality/quality-2.jpg') }}"
                                class="rounded-3xl shadow-2xl aspect-square object-cover mt-12">

                            <img src="{{ asset('storage/quality/quality-3.jpg') }}"
                                class="rounded-3xl shadow-2xl aspect-square object-cover">

                        </div>

                    </div>

                    {{-- RIGHT --}}
                    <div class="text-white">

                        <h2 class="text-4xl sm:text-5xl font-bold tracking-tight mb-8">
                            Quality Commitment
                        </h2>

                        <ul class="space-y-4 text-lg">

                            <li class="flex items-start gap-3">
                                <span class="text-[#e31e24] text-2xl leading-none mt-1">•</span>
                                <span>Strict quality control</span>
                            </li>

                            <li class="flex items-start gap-3">
                                <span class="text-[#e31e24] text-2xl leading-none mt-1">•</span>
                                <span>High safety & efficacy standards</span>
                            </li>

                            <li class="flex items-start gap-3">
                                <span class="text-[#e31e24] text-2xl leading-none mt-1">•</span>
                                <span>Continuous technology investment</span>
                            </li>

                            <li class="flex items-start gap-3">
                                <span class="text-[#e31e24] text-2xl leading-none mt-1">•</span>
                                <span>Partner with a trusted pharmaceutical manufacturer</span>
                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </section>

        {{-- Trusted --}}
        <section
            class="relative w-screen left-1/2 right-1/2 -mx-[50vw] h-[300px] flex items-center justify-center overflow-hidden">

            <!-- Background Image -->
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                style="background-image: url('{{ asset('storage/backgrounds/pharma-hands-bg.jpg') }}');">
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

    </section>
@endsection
