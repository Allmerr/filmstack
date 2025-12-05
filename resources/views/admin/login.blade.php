<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Filmstack</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              primary: '#00e054',
              primaryHover: '#00b042',
              dark: '#14181c',
              darker: '#0c1014',
              surface: '#2c3440',
              textMuted: '#99aabb',
            }
          }
        }
      }
    </script>
</head>
<body class="bg-dark min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md px-6">
        <!-- Logo/Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center">
                    <svg class="w-7 h-7 text-dark" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V9.3l7-3.11v6.8z"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white">Admin Panel</h1>
            </div>
            <p class="text-textMuted text-sm">Sign in to access the admin dashboard</p>
        </div>

        <!-- Login Card -->
        <div class="bg-[#1f252b] rounded-lg border border-gray-800 p-8 shadow-xl">
            @if(session('success'))
                <div class="mb-4 p-3 rounded bg-green-900/20 border border-green-500/30 text-green-400 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-3 rounded bg-red-900/20 border border-red-500/30 text-red-400 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-semibold text-white mb-2">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 rounded bg-dark border border-gray-700 text-white placeholder-textMuted focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all"
                        placeholder="admin@filmstack.com"
                        required
                        autofocus
                    >
                    @error('email')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-semibold text-white mb-2">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="w-full px-4 py-3 rounded bg-dark border border-gray-700 text-white placeholder-textMuted focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all"
                        placeholder="••••••••"
                        required
                    >
                    @error('password')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center text-sm text-textMuted cursor-pointer">
                        <input type="checkbox" name="remember" class="mr-2 rounded border-gray-700 bg-dark text-primary focus:ring-primary focus:ring-offset-dark">
                        Remember me
                    </label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full bg-primary hover:bg-primaryHover text-dark font-bold py-3 rounded transition-colors duration-200 flex items-center justify-center gap-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Sign In
                </button>
            </form>
        </div>

        <!-- Back to Site -->
        <div class="text-center mt-6">
            <a href="{{ route('welcome') }}" class="text-textMuted hover:text-primary text-sm transition-colors flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Filmstack
            </a>
        </div>
    </div>
</body>
</html>
