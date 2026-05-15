<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPHAC Admin | Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            dark: '#0f172a',
                            primary: '#3b82f6',
                            danger: '#ef4444'
                        }
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        
        /* Premium Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #475569;
        }

        /* Smooth backdrop blur */
        .glass-header {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
</head>
<body class="bg-[#f8fafc] font-sans text-slate-900 overflow-x-hidden">

    <div class="min-h-screen flex" x-data="{ sidebarOpen: false }">

        <!-- Mobile Sidebar Overlay -->
        <div
            x-show="sidebarOpen"
            x-transition.opacity
            x-cloak
            class="fixed inset-0 z-40 bg-slate-950/60 lg:hidden backdrop-blur-sm"
            @click="sidebarOpen = false">
        </div>

        <!-- Sidebar Navigation - FIXED -->
        <aside
            class="fixed inset-y-0 left-0 z-50 flex w-72 max-w-[85vw] flex-col bg-[#0f172a] text-slate-200 transition-transform duration-300 border-r border-slate-800"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">

            <!-- Brand Identity -->
            <div class="flex items-center justify-between border-b border-slate-800/60 px-6 py-6 min-h-[90px]">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white p-1.5 shadow-lg shadow-blue-500/10">
                        <img src="{{ asset('images/ephac-logo.png') }}" alt="Logo" class="h-full w-auto">
                    </div>
                    <span class="text-xl font-bold tracking-tight text-white uppercase">EPHAC<span class="text-blue-500">.</span></span>
                </div>
                <button type="button" class="rounded-xl p-2 text-slate-400 hover:bg-slate-800 lg:hidden" @click="sidebarOpen = false">
                    <i class="fa-solid fa-arrow-left text-lg"></i>
                </button>
            </div>

            <!-- Scrollable Nav Links -->
            <div class="flex-1 overflow-y-auto px-4 py-8 custom-scrollbar">
                
                <!-- Group: Main Content -->
                <p class="mb-4 px-4 text-[10px] font-bold uppercase tracking-widest text-slate-500">Content Management</p>
                
                <nav class="space-y-1.5">
                    <a href="{{ route('admin.home.cms') }}"
                        class="group flex items-center gap-3 rounded-xl px-4 py-3 text-slate-400 transition-all duration-200 hover:bg-blue-600/10 hover:text-white
                        {{ request()->routeIs('admin.home.cms') ? 'bg-blue-600/15 text-blue-400 ring-1 ring-blue-500/30' : '' }}">
                        <i class="fa-solid fa-house w-6 text-center text-lg transition-transform group-hover:scale-110"></i>
                        <span class="font-semibold text-sm">Homepage CMS</span>
                        @if(request()->routeIs('admin.home.cms'))
                            <div class="ml-auto h-1.5 w-1.5 rounded-full bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.6)]"></div>
                        @endif
                    </a>

                    <a href="{{ route('admin.about.cms') }}"
                        class="group flex items-center gap-3 rounded-xl px-4 py-3 text-slate-400 transition-all duration-200 hover:bg-blue-600/10 hover:text-white
                        {{ request()->routeIs('admin.about.cms') ? 'bg-blue-600/15 text-blue-400 ring-1 ring-blue-500/30' : '' }}">
                        <i class="fa-solid fa-circle-info w-6 text-center text-lg transition-transform group-hover:scale-110"></i>
                        <span class="font-semibold text-sm">About Us Page</span>
                        @if(request()->routeIs('admin.about.cms'))
                            <div class="ml-auto h-1.5 w-1.5 rounded-full bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.6)]"></div>
                        @endif
                    </a>

                    <a href="{{ route('admin.products.cms') }}"
                        class="group flex items-center gap-3 rounded-xl px-4 py-3 text-slate-400 transition-all duration-200 hover:bg-blue-600/10 hover:text-white
                        {{ request()->routeIs('admin.products.cms') || request()->routeIs('admin.product.*') ? 'bg-blue-600/15 text-blue-400 ring-1 ring-blue-500/30' : '' }}">
                        <i class="fa-solid fa-pills w-6 text-center text-lg transition-transform group-hover:scale-110"></i>
                        <span class="font-semibold text-sm">Product Page</span>
                        @if(request()->routeIs('admin.products.cms') || request()->routeIs('admin.product.*'))
                            <div class="ml-auto h-1.5 w-1.5 rounded-full bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.6)]"></div>
                        @endif
                    </a>
                </nav>

                <!-- Group: System -->
                <p class="mb-4 mt-10 px-4 text-[10px] font-bold uppercase tracking-widest text-slate-500">System Control</p>
                <nav class="space-y-1.5">
                    <a href="#" class="group flex items-center gap-3 rounded-xl px-4 py-3 text-slate-400 transition-all hover:bg-slate-800 hover:text-white">
                        <i class="fa-solid fa-gear w-6 text-center text-lg"></i>
                        <span class="font-semibold text-sm">General Settings</span>
                    </a>
                    
                    
                </nav>
            </div>

            <!-- Footer Account Card -->
            <div class="p-4">
                <div class="rounded-2xl bg-slate-800/40 border border-slate-700/50 p-4">
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 text-sm font-bold text-white shadow-lg">
                                E
                            </div>
                            <div class="absolute -bottom-0.5 -right-0.5 h-3 w-3 rounded-full border-2 border-[#0f172a] bg-green-500"></div>
                        </div>
                        <div class="flex-1 overflow-hidden">
                            <p class="truncate text-sm font-bold text-white">Administrator</p>
                            <p class="truncate text-[11px] text-slate-400">EPHAC Dashboard</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Workspace -->
        <div class="flex-1 flex flex-col lg:ml-72">
            
            <!-- Sticky Header -->
            <header class="sticky top-0 z-30 border-b border-slate-200 glass-header">
                <div class="flex items-center justify-between px-4 py-4 sm:px-6 lg:px-8 h-[90px]">
                    <div class="flex items-center gap-4">
                        <button type="button" class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 transition lg:hidden" @click="sidebarOpen = true">
                            <i class="fa-solid fa-bars-staggered"></i>
                        </button>
                        <div>
                            <p class="text-sm font-bold text-slate-900">Admin Dashboard</p>
                            <nav class="flex text-[11px] text-slate-500" aria-label="Breadcrumb">
                                <span class="hover:text-blue-600 cursor-pointer">EPHAC</span>
                                <span class="mx-1 text-slate-300">/</span>
                                <span class="text-slate-400 capitalize">
                                    {{ str_replace(['.', '-'], ' ', request()->route()->getName() ?? 'Dashboard') }}
                                </span>
                            </nav>
                        </div>
                    </div>

                    <!-- Header Actions -->
                    <div class="flex items-center gap-3">
                        <div class="hidden sm:block h-8 w-px bg-slate-200 mx-2"></div>
                        <a href="/" target="_blank" class="flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100 transition">
                            <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                            <span>Live Site</span>
                        </a>
                    </div>
                </div>
            </header>

            <!-- Dynamic Content Area -->
            <main class="min-w-0 flex-1 px-4 py-8 sm:px-6 lg:px-10">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>