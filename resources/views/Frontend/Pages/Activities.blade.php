@extends('Frontend.Layout.Main')

@section('content')
    <div class="relative mx-auto max-w-7xl">

        <div class="rounded-t-[40px]">
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
                            Activities
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
        </div>

        <section id="activities" class="overflow-hidden bg-white px-6 py-24">
            <div class="mx-auto max-w-7xl">
                <h2 class="mb-24 text-center text-4xl font-bold uppercase tracking-tight text-[#1447b7] md:text-5xl">
                    Activities
                </h2>

                @if ($categories->isEmpty())
                    <div class="rounded-[32px] border border-dashed border-gray-300 bg-gray-50 px-8 py-16 text-center">
                        <h3 class="text-2xl font-bold text-[#1447b7]">No activities yet</h3>
                        <p class="mt-3 text-gray-600">Please add activity categories and items from the admin page.</p>
                    </div>
                @else
                    <div class="space-y-32">
                        @foreach ($categories as $index => $category)
                            @php $isEven = $index % 2 === 0; @endphp

                            <div
                                class="flex flex-col items-start gap-12 lg:gap-24 {{ $isEven ? 'md:flex-row' : 'md:flex-row-reverse' }}">

                                <div class="w-full md:w-1/2">
                                    <div
                                        class="aspect-video w-full overflow-hidden rounded-[40px] border border-gray-100 bg-gray-200 shadow-sm">
                                        @if ($category->image)
                                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->title }}"
                                                class="h-full w-full object-cover">
                                        @else
                                            <div
                                                class="flex h-full items-center justify-center bg-gradient-to-br from-[#dff3ff] to-[#c7e7ff] px-6 text-center text-lg font-semibold text-[#1447b7]">
                                                {{ $category->title }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="w-full md:w-1/2 {{ $isEven ? 'text-left' : 'text-right' }}"
                                    x-data="{ selected: null }">
                                    <h3 class="mb-6 text-2xl font-bold uppercase leading-tight text-[#1447b7] md:text-3xl">
                                        {{ $category->title }}
                                    </h3>

                                    <div class="space-y-4 text-lg text-gray-700">
                                        @forelse ($category->items as $item)
                                            @php $itemId = 'item-' . $item->id; @endphp
                                            <div>
                                                <button
                                                    @click="selected !== '{{ $itemId }}' ? selected = '{{ $itemId }}' : selected = null"
                                                    class="font-medium transition-colors hover:text-[#1447b7] focus:outline-none"
                                                    :class="selected === '{{ $itemId }}' ? 'text-[#1447b7]' : ''">
                                                    {{ $item->name }}
                                                </button>

                                                <div x-show="selected === '{{ $itemId }}'" x-collapse x-cloak
                                                    class="mt-2 border-l-4 border-[#1447b7] bg-gray-50 p-4 text-sm text-gray-500">
                                                    {{ $item->description }}
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-base text-gray-500">No activity details added for this section yet.</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <div class="bg-white font-sans text-[#222]">
            <section
                class="relative left-1/2 right-1/2 -mx-[50vw] flex h-[300px] w-screen items-center justify-center overflow-hidden">
                <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-[#0a2a5e]/80 via-[#1e4a8a]/70 to-[#0a2a5e]/80"></div>

                <div class="relative z-10 mx-auto max-w-4xl px-6 text-center">
                    <h2 class="text-4xl font-bold leading-tight tracking-tight text-white drop-shadow-2xl md:text-4xl lg:text-4xl">
                        Trusted Pharmaceutical Manufacturer in <br>
                        <span>Cambodia</span>
                    </h2>
                </div>
            </section>
        </div>
    </div>
@endsection
