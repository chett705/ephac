{{-- resources/views/auth/login.blade.php --}}
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>



<div class="min-h-screen bg-gray-100 flex items-center justify-center px-4 py-10">
    
    <div class="w-full max-w-md bg-white shadow-2xl rounded-3xl overflow-hidden">

        {{-- Top Section --}}
        <div class="bg-blue-600 text-white text-center py-8 px-6">
            <h1 class="text-3xl font-bold"> EPHAC Admin</h1>
            <p class="mt-2 text-sm text-blue-100">
              
            </p>
        </div>

        {{-- Form Section --}}
        <div class="p-8">

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

            <form action="" method="POST">
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

