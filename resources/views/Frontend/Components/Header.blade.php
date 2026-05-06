@php
    $navItems = [
        ['label' => 'Home', 'href' => '/'],
        ['label' => 'About Us', 'href' => '#about'],
        ['label' => 'Products', 'href' => '#products'],
        ['label' => 'Manufacturing', 'href' => '#manufacturing'],
        ['label' => 'Services', 'href' => '#services'],
        ['label' => 'News', 'href' => '#news'],
        ['label' => 'Insights', 'href' => '#insights'],
    ];
@endphp

<header class="sticky top-0 z-50 bg-white/95 backdrop-blur-xl">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8" x-data="{ open: false }">
        <div class="flex min-h-[78px] items-center justify-between gap-4">
            <a href="/" class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-sm border-2 border-[#1f4ed8] bg-white text-[10px] font-extrabold text-[#e61d23] shadow-sm">
                    EPHAC
                </div>
                <div class="hidden sm:block">
                    <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-[#1f4ed8]">Pharmaceutical Manufacturer</p>
                    <p class="text-sm font-extrabold text-[#e61d23]">EPHAC Co., LTD.</p>
                </div>
            </a>

            <nav class="hidden items-center gap-1 xl:flex">
                @foreach ($navItems as $index => $item)
                    <a href="{{ $item['href'] }}"
                        class="{{ $index === 0 ? 'bg-[#1f56e6] text-white shadow-lg shadow-blue-200' : 'text-slate-900 hover:text-[#1f56e6]' }} rounded-full px-5 py-2 text-sm font-semibold transition">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="hidden items-center gap-4 xl:flex">
                <a href="#" class="text-[#1877F2] transition hover:scale-110">
                    <i class="fa-brands fa-facebook text-sm"></i>
                </a>
                <a href="#" class="text-[#229ED9] transition hover:scale-110">
                    <i class="fa-brands fa-telegram text-sm"></i>
                </a>
                <a href="#" class="text-[#25D366] transition hover:scale-110">
                    <i class="fa-brands fa-whatsapp text-sm"></i>
                </a>
                <a href="#" class="text-[#E4405F] transition hover:scale-110">
                    <i class="fa-brands fa-instagram text-sm"></i>
                </a>
            </div>

            <button type="button" @click="open = !open"
                class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-slate-200 text-slate-700 transition hover:bg-slate-50 xl:hidden">
                <i class="fa-solid" :class="open ? 'fa-xmark' : 'fa-bars'"></i>
            </button>
        </div>

        <div x-show="open" x-transition.origin.top class="border-t border-slate-200 py-4 xl:hidden">
            <nav class="flex flex-col gap-2">
                @foreach ($navItems as $index => $item)
                    <a href="{{ $item['href'] }}"
                        class="{{ $index === 0 ? 'bg-[#1f56e6] text-white' : 'text-slate-700 hover:bg-slate-100' }} rounded-2xl px-4 py-3 text-sm font-semibold transition">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>
        </div>
    </div>
</header>
