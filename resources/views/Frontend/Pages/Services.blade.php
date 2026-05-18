@extends('Frontend.Layout.Main')

@section('content')
    <section
        class="relative h-[620px] overflow-hidden rounded-[45px] bg-gradient-to-br from-[#dff3ff] via-[#c7e7ff] to-[#b2d9ff] shadow-[0_20px_50px_rgba(30,76,161,0.15)] lg:h-[720px]">

        <div class="absolute inset-0 overflow-hidden rounded-[45px]">
            <iframe width="100%" height="100%"
                src="https://www.youtube.com/embed/mgR1Mwnram8?autoplay=1&loop=1&playlist=mgR1Mwnram8&mute=1&controls=0"
                frameborder="0" allowfullscreen>
            </iframe>

            <div class="absolute inset-0 bg-black/40"></div>
        </div>

        <div class="relative z-20 grid h-full items-center gap-8 px-8 py-12 lg:grid-cols-2 lg:px-14 lg:py-20">
            <div class="max-w-2xl">
                <h1 class="text-6xl font-black uppercase tracking-tight text-[#e31e24] sm:text-7xl lg:text-8xl">
                    SERVICES /
                    PARTNERSHIP
                </h1>

                <h2 class="mt-4 text-3xl font-bold leading-tight text-white sm:text-4xl lg:text-5xl">
                    Trusted Pharmaceutical Manufacturer in Cambodia
                </h2>

                <p class="mt-6 max-w-lg text-base leading-relaxed text-white/90">
                    Explore our latest activities, partnerships, and community initiatives across healthcare,
                    quality, and corporate responsibility.
                </p>

                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="#activities"
                        class="rounded-full bg-[#1452db] px-10 py-3.5 text-sm font-bold text-white transition hover:bg-[#0f3a9e]">
                        View Activities
                    </a>

                    <a href="/products"
                        class="rounded-full bg-white px-10 py-3.5 text-sm font-bold text-[#1452db] transition hover:bg-gray-100">
                        Explore Products
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
