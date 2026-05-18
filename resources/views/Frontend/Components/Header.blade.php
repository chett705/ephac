@php
    $logoImage = asset('storage/730462c5ff076ec199c20fa807f30cecc20de9ea (4).png');
    $currentPath = request()->path() === '/' ? '/' : '/' . request()->path();

    $navItems = [
        ['label' => 'Home',          'href' => '/'],
        ['label' => 'About Us',      'href' => '/about-us'],
        ['label' => 'Products',      'href' => '/products'],
        ['label' => 'Services',      'href' => 'services', 'dropdown' => true],
        ['label' => 'Activities',    'href' => '/activites'],
        ['label' => 'Insights',      'href' => '/insight'],
        ['label' => 'Contact Us',    'href' => '/contact'],
    ];

    $serviceItems = [
        ['label' => 'Contract Manufacturing', 'href' => '/services/contract-manufacturing'],
        ['label' => 'Private Label (OEM)',    'href' => '/services/private-label'],
        ['label' => 'Distribution Partnership','href' => '/services/distribution-partnership'],
        ['label' => 'Export',                 'href' => '/services/export'],
    ];
@endphp

<!-- Header -->
<header class="sticky top-0 z-40 bg-white/95 backdrop-blur-xl border-b border-slate-100" 
        x-data="{ open: false, servicesOpen: false }">
    
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">

            <!-- Logo -->
            <a href="/" class="flex-shrink-0 z-50">
                <img src="{{ $logoImage }}" alt="EPHAC Logo" class="h-10 w-auto object-contain">
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden items-center gap-1 xl:flex">
                @foreach ($navItems as $item)
                    @if (isset($item['dropdown']) && $item['dropdown'])
                        <!-- Services Dropdown -->
                        <div class="relative group">
                            <a href="/services"
                               class="flex items-center gap-1 px-5 py-2.5 text-sm font-semibold rounded-full transition-all
                                      {{ str_starts_with($currentPath, '/services') ? 'bg-[#0a38a0] text-white shadow-md' : 'text-slate-700 hover:bg-slate-100' }}">
                                Services / Partnership
                                <i class="fa-solid fa-chevron-down text-xs transition-transform group-hover:rotate-180"></i>
                            </a>
                            
                            <!-- Dropdown Menu -->
                            <div class="absolute left-1/2 -translate-x-1/2 pt-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                                <div class="bg-white rounded-2xl shadow-xl py-3 px-2 w-72 border border-slate-100">
                                    @foreach ($serviceItems as $service)
                                        <a href="{{ $service['href'] }}"
                                           class="flex items-center px-6 py-3 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-[#0a38a0] rounded-xl transition-colors">
                                            {{ $service['label'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        @php
                            $isActive = ($currentPath === $item['href'] || (str_starts_with($currentPath, trim($item['href'], '/')) && $item['href'] !== '/'));
                        @endphp
                        <a href="{{ $item['href'] }}"
                           class="{{ $isActive ? 'bg-[#0a38a0] text-white shadow-md' : 'text-slate-700 hover:bg-slate-100' }} 
                                  px-5 py-2.5 text-sm font-semibold rounded-full transition-all">
                            {{ $item['label'] }}
                        </a>
                    @endif
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

    <!-- ==================== MOBILE MENU ==================== -->
    <template x-teleport="body">
        <div x-show="open" 
             x-cloak
             class="fixed inset-0 z-[60] bg-white flex flex-col xl:hidden">
            
            <!-- Mobile Header -->
            <div class="flex h-20 items-center justify-between px-4 border-b border-slate-100">
                <img src="{{ $logoImage }}" alt="Logo" class="h-9 w-auto">
                <button @click="open = false" class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-slate-100">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <!-- Mobile Menu Links -->
            <div class="flex-1 overflow-y-auto px-6 py-8">
                <nav class="flex flex-col gap-2">
                    @foreach ($navItems as $item)
                        @if (isset($item['dropdown']) && $item['dropdown'])
                            <!-- Mobile Services Accordion -->
                            <div>
                                <button @click="servicesOpen = !servicesOpen"
                                        class="w-full flex items-center justify-between px-5 py-4 text-base font-semibold text-slate-700 hover:bg-slate-50 rounded-2xl transition-all">
                                    <span>Services / Partnership</span>
                                    <i class="fa-solid fa-chevron-down transition-transform" 
                                       :class="{ 'rotate-180': servicesOpen }"></i>
                                </button>
                                
                                <div x-show="servicesOpen" class="pl-6 mt-1 space-y-1">
                                    @foreach ($serviceItems as $service)
                                        <a href="{{ $service['href'] }}" @click="open = false"
                                           class="block px-5 py-3 text-sm font-medium text-slate-600 hover:text-[#0a38a0] rounded-xl">
                                            {{ $service['label'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            @php
                                $isActive = ($currentPath === $item['href'] || (str_starts_with($currentPath, trim($item['href'], '/')) && $item['href'] !== '/'));
                            @endphp
                            <a href="{{ $item['href'] }}" @click="open = false"
                               class="{{ $isActive ? 'bg-[#0a38a0] text-white' : 'text-slate-700 hover:bg-slate-50' }} 
                                      px-5 py-4 text-base font-semibold rounded-2xl transition-all">
                                {{ $item['label'] }}
                            </a>
                        @endif
                    @endforeach
                </nav>

                <!-- Social Icons -->
                <div class="mt-12 flex items-center gap-6 px-5">
                    <a href="#" class="text-[#1877F2] text-2xl"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="text-[#229ED9] text-2xl"><i class="fa-brands fa-telegram"></i></a>
                    <a href="#" class="text-[#25D366] text-2xl"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="#" class="text-[#E4405F] text-2xl"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </template>
</header>