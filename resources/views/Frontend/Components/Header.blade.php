@php
    $logoImage = asset('storage/730462c5ff076ec199c20fa807f30cecc20de9ea (4).png');
    $currentPath = request()->path() === '/' ? '/' : '/' . request()->path();

    $navItems = [
        ['label' => 'Home',          'href' => '/'],
        ['label' => 'About Us',      'href' => '/about-us'],
        ['label' => 'Products',      'href' => '/products'],
        ['label' => 'Manufacturing', 'href' => '/manufacturing'],
        ['label' => 'Services',      'href' => '/services'],
        ['label' => 'News',          'href' => '/news'],
        ['label' => 'Insights',      'href' => '/insights'],
    ];
@endphp

<!-- Header -->
<header class="sticky top-0 z-40 bg-white/95 backdrop-blur-xl border-b border-slate-100" 
        x-data="{ open: false }"
        x-init="$watch('open', value => value ? document.body.classList.add('overflow-hidden') : document.body.classList.remove('overflow-hidden'))">
    
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">

            <!-- Logo -->
            <a href="/" class="flex-shrink-0 z-50">
                <img src="{{ $logoImage }}" alt="EPHAC Logo" class="h-10 w-auto object-contain">
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden items-center gap-1 xl:flex">
                @foreach ($navItems as $item)
                    @php
                        $isActive = ($currentPath === $item['href'] || (str_starts_with($currentPath, trim($item['href'], '/')) && $item['href'] !== '/'));
                    @endphp
                    <a href="{{ $item['href'] }}"
                       class="{{ $isActive ? 'bg-[#0a38a0] text-white shadow-md' : 'text-slate-700 hover:bg-slate-100' }} 
                              px-5 py-2.5 text-sm font-semibold rounded-full transition-all">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <!-- Mobile Menu Button -->
            <button @click="open = !open" 
                    type="button"
                    class="xl:hidden z-50 inline-flex h-11 w-11 items-center justify-center rounded-full bg-slate-50 text-slate-700">
                <i class="fa-solid" :class="open ? 'fa-xmark text-xl' : 'fa-bars'"></i>
            </button>
        </div>
    </div>

    <!-- Full Screen Mobile Menu -->
    <template x-teleport="body">
        <div x-show="open" 
             x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-x-full"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 translate-x-full"
             class="fixed inset-0 z-[60] bg-white flex flex-col xl:hidden">
            
            <!-- Mobile Header inside Menu -->
            <div class="flex h-20 items-center justify-between px-4 border-b border-slate-50">
                <img src="{{ $logoImage }}" alt="Logo" class="h-9 w-auto">
                <button @click="open = false" class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-slate-100">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <!-- Menu Links (Standard Size) -->
            <div class="flex-1 overflow-y-auto px-6 py-10">
                <nav class="flex flex-col gap-2">
                    @foreach ($navItems as $item)
                        @php
                            $isActive = ($currentPath === $item['href'] || (str_starts_with($currentPath, trim($item['href'], '/')) && $item['href'] !== '/'));
                        @endphp
                        <a href="{{ $item['href'] }}" @click="open = false"
                           class="{{ $isActive ? 'bg-[#0a38a0] text-white' : 'text-slate-700 hover:bg-slate-50' }} 
                                  px-5 py-4 text-base font-semibold rounded-2xl transition-all">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>

                <!-- Social Icons -->
                <div class="mt-10 flex items-center gap-6 px-5">
                    <a href="#" class="text-[#1877F2] text-xl"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="text-[#229ED9] text-xl"><i class="fa-brands fa-telegram"></i></a>
                    <a href="#" class="text-[#25D366] text-xl"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="#" class="text-[#E4405F] text-xl"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>

            <!-- Bottom Space / Footer -->
           
        </>
    </template>
</header>