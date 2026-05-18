<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EPHAC Admin Login</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
<div class="flex min-h-screen items-center justify-center bg-gray-100 px-4 py-6 sm:py-10">
    
    <div class="w-full max-w-md overflow-hidden rounded-3xl bg-white shadow-2xl">

        {{-- Top Section --}}
        <div class="bg-blue-600 px-5 py-7 text-center text-white sm:px-6 sm:py-8">
            <h1 class="text-2xl font-bold sm:text-3xl">EPHAC Admin</h1>
            <p class="mt-2 text-sm text-blue-100">
              
            </p>
        </div>

        {{-- Form Section --}}
        <div class="p-5 sm:p-8">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error Message --}}
            @if(session('error'))
                <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                {{-- Email --}}
                <div class="mb-5">
                    <label class="block text-gray-700 font-semibold mb-2">
                        Email Address
                    </label>

                    <input 
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >

                    @error('email')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-5">
                    <label class="block text-gray-700 font-semibold mb-2">
                        Password
                    </label>

                    <input 
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >

                    @error('password')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Remember --}}
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2 text-sm text-gray-600">
                        <input type="checkbox" name="remember">
                        Remember Me
                    </label>

                   
                </div>

                {{-- Login Button --}}
                <button 
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition duration-300"
                >
                    Login
                </button>

            </form>

           

        </div>
    </div>
    </div>
</div>
</body>
</html>

