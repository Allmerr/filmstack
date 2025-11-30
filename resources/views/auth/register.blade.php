@extends('layouts.main')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-dark px-4">
        <div class="w-full max-w-md bg-darker rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold text-white mb-6 text-center">Sign Up for an Account</h2>
            <form method="POST" action="{{ route('register.store') }}">
                @csrf
                 @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-600 text-white rounded-md">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                @endif
                <div class="mb-4">
                   
                    <label for="email" class="block text-sm font-medium text-textMuted mb-2">Email Address</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        required 
                        class="w-full px-4 py-2 bg-surface text-white rounded-md focus:outline-none focus:ring-2 focus:ring-primary placeholder-gray-500"
                        placeholder="Enter your email"
                    />
                </div>
                <div class="mb-4">
                    <label for="username" class="block text-sm font-medium text-textMuted mb-2">Username</label>
                    <input 
                        type="text" 
                        name="username" 
                        id="username" 
                        required 
                        class="w-full px-4 py-2 bg-surface text-white rounded-md focus:outline-none focus:ring-2 focus:ring-primary placeholder-gray-500"
                        placeholder="Enter your username"
                    />
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-textMuted mb-2">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        required 
                        class="w-full px-4 py-2 bg-surface text-white rounded-md focus:outline-none focus:ring-2 focus:ring-primary placeholder-gray-500"
                        placeholder="Enter your password"
                    />
                </div>
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-textMuted mb-2">Confirm Password</label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation" 
                        required 
                        class="w-full px-4 py-2 bg-surface text-white rounded-md focus:outline-none focus:ring-2 focus:ring-primary placeholder-gray-500"
                        placeholder="Enter your confirm password"
                    />
                </div>
                <button type="submit" class="w-full bg-primary hover:bg-primaryHover text-white font-bold py-2 px-4 rounded-md transition-colors">
                    Sign In
                </button>
            </form>
        </div>
    </div>
@endsection