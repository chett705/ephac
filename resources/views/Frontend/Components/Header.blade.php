@php
$logoImage = asset('storage/730462c5ff076ec199c20fa807f30cecc20de9ea (4).png');

$currentPath = request()->path() === '/' ? '/' : '/' . request()->path();

$navItems = [
    ['label' => 'Home',         'href' => '/'],
    ['label' => 'About Us',     'href' => '/about-us'],
    ['label' => 'Products',     'href' => '/products'],
    ['label' => 'Manufacturing', 'href' => '/manufacturing'],
    ['label' => 'Services',     'href' => '/services'],
    ['label' => 'News',         'href' => '/news'],
    ['label' => 'Insights',     'href' => '/insights'],
];
@endphp

<header class="sticky top-0 z-50 bg-white/95 backdrop-blur-xl border-b border-slate-100">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8" x-data="{ open: false }">
        <div class="flex min-h-[78px] items-center justify-between gap-4">

            <!-- Logo -->
            <a href="/" class="flex items-center gap-3">
                <img src="{{ $logoImage }}" alt="EPHAC Logo" class="h-10 w-auto object-contain">
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden items-center gap-2 xl:flex">
                @foreach ($navItems as $item)
                    @php
                        $isActive = ($currentPath === $item['href'] || 
                                    (str_starts_with($currentPath, trim($item['href'], '/')) && $item['href'] !== '/'));
                    @endphp
                    
                    <a href="{{ $item['href'] }}"
                       class="{{ $isActive 
                            ? 'bg-[#0a38a0] text-white shadow-md px-8 py-3 text-sm font-semibold rounded-full' 
                            : 'text-slate-700 hover:text-[#004eff] hover:bg-slate-100 px-5 py-3 text-sm font-semibold rounded-full transition-all' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <!-- Social Icons -->
            <div class="hidden items-center gap-6 xl:flex">
                <a href="#" class="text-[#1877F2] hover:scale-125 transition"><i class="fa-brands fa-facebook text-2xl"></i></a>
                <a href="#" class="text-[#229ED9] hover:scale-125 transition"><i class="fa-brands fa-telegram text-2xl"></i></a>
                <a href="#" class="text-[#25D366] hover:scale-125 transition"><i class="fa-brands fa-whatsapp text-2xl"></i></a>
                <a href="#" class="text-[#E4405F] hover:scale-125 transition"><i class="fa-brands fa-instagram text-2xl"></i></a>
            </div>

            <!-- Mobile Menu Button -->
            <button @click="open = !open" 
                    class="xl:hidden inline-flex h-11 w-11 items-center justify-center rounded-full border border-slate-200 text-slate-700 hover:bg-slate-50 transition">
                <i class="fa-solid" :class="open ? 'fa-xmark' : 'fa-bars'"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" x-transition class="xl:hidden border-t border-slate-200 py-4">
            <nav class="flex flex-col gap-2">
                @foreach ($navItems as $item)
                    @php
                        $isActive = ($currentPath === $item['href'] || 
                                    (str_starts_with($currentPath, trim($item['href'], '/')) && $item['href'] !== '/'));
                    @endphp
                    <a href="{{ $item['href'] }}"
                       class="{{ $isActive 
                            ? 'bg-[#0a38a0] text-white' 
                            : 'text-slate-700 hover:bg-slate-100' }} 
                            rounded-2xl px-5 py-3 text-sm font-semibold transition">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>
        </div>
    </div>
</header>