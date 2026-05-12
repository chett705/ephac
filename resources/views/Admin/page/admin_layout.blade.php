<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EPHAC Sidebar - Tailwind</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  
  <script>
    tailwind.config = {
      content: [],
      theme: {
        extend: {}
      }
    }
  </script>
</head>
<body class="bg-gray-50 font-sans">

  <!-- resources/views/admin/partials/sidebar.blade.php -->

<div class="flex h-screen">

  <!-- Sidebar -->
  <div class="w-72 bg-slate-900 text-slate-200 flex flex-col">

    <!-- Logo -->
    <div class="px-6 py-8 border-b border-slate-700">
      <div class="flex items-center gap-4">
        <img src="{{ asset('images/ephac-logo.png') }}" 
             alt="EPHAC Logo" 
             class="h-14 w-auto">
      </div>
    </div>

    <!-- Navigation -->
    <div class="flex-1 px-4 py-6 space-y-1">

      <!-- Homepage -->
      <a href="{{ route('admin.home.cms') }}" 
         class="flex items-center gap-3 px-5 py-3 text-slate-300 hover:bg-slate-800 hover:text-white rounded-2xl transition-all 
                {{ request()->routeIs('admin.home.cms') ? 'bg-slate-800 text-white' : '' }}">
        <i class="fa-solid fa-house text-xl w-6"></i>
        <span class="font-medium">Homepage</span>
      </a>

      <!-- About Page -->
      <a href="{{ route('admin.about.cms') }}" 
         class="flex items-center gap-3 px-5 py-3 text-slate-300 hover:bg-slate-800 hover:text-white rounded-2xl transition-all 
                {{ request()->routeIs('admin.about.cms') ? 'bg-slate-800 text-white' : '' }}">
        <i class="fa-solid fa-user text-xl w-6"></i>
        <span class="font-medium">About Page</span>
      </a>

      <!-- Product Page -->
      <a href="{{ route('admin.products.index') }}" 
         class="flex items-center gap-3 px-5 py-3 text-slate-300 hover:bg-slate-800 hover:text-white rounded-2xl transition-all 
                {{ request()->routeIs('admin.products.*') || request()->routeIs('admin.product_categories.*') || request()->routeIs('admin.product_subcategories.*') ? 'bg-slate-800 text-white' : '' }}">
        <i class="fa-solid fa-box text-xl w-6"></i>
        <span class="font-medium">Product Page</span>
      </a>

    </div>

    <!-- Footer -->
    <div class="p-6 border-t border-slate-700">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-red-600 rounded-2xl flex items-center justify-center text-white font-semibold text-lg">
          E
        </div>
        <div>
          <p class="font-semibold text-white">EPHAC Co., Ltd.</p>
          <p class="text-xs text-slate-400">Administrator</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content Area -->
  <div class="flex-1 overflow-auto">
    @yield('content')
  </div>

</div>

@stack('scripts')

</body>
</html>
