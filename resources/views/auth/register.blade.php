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
                    <div class="relative">
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            required 
                            class="w-full px-4 py-2 bg-surface text-white rounded-md focus:outline-none focus:ring-2 focus:ring-primary placeholder-gray-500 pr-10"
                            placeholder="Enter your password"
                        />
                        <button 
                            type="button" 
                            id="toggle-password" 
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-textMuted hover:text-white transition-colors focus:outline-none"
                        >
                            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    <!-- Password Validation Feedback -->
                    <div class="mt-3 space-y-2">
                        <div class="flex items-center gap-2">
                            <span id="length-check" class="text-gray-500">○</span>
                            <span class="text-sm text-gray-400">At least 8 characters</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span id="uppercase-check" class="text-gray-500">○</span>
                            <span class="text-sm text-gray-400">At least 1 uppercase letter (A-Z)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span id="number-check" class="text-gray-500">○</span>
                            <span class="text-sm text-gray-400">At least 1 number (0-9)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span id="special-check" class="text-gray-500">○</span>
                            <span class="text-sm text-gray-400">At least 1 special character (*, _, -, etc.)</span>
                        </div>
                    </div>
                </div>
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-textMuted mb-2">Confirm Password</label>
                    <div class="relative">
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation" 
                            required 
                            class="w-full px-4 py-2 bg-surface text-white rounded-md focus:outline-none focus:ring-2 focus:ring-primary placeholder-gray-500 pr-10"
                            placeholder="Enter your confirm password"
                        />
                        <button 
                            type="button" 
                            id="toggle-password-confirm" 
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-textMuted hover:text-white transition-colors focus:outline-none"
                        >
                            <svg id="eye-icon-confirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <button type="submit" class="w-full bg-primary hover:bg-primaryHover text-white font-bold py-2 px-4 rounded-md transition-colors">
                    Sign In
                </button>
            </form>
        </div>
    </div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const passwordConfirmInput = document.getElementById('password_confirmation');
    const togglePasswordBtn = document.getElementById('toggle-password');
    const togglePasswordConfirmBtn = document.getElementById('toggle-password-confirm');
    const eyeIcon = document.getElementById('eye-icon');
    const eyeIconConfirm = document.getElementById('eye-icon-confirm');
    
    const lengthCheck = document.getElementById('length-check');
    const uppercaseCheck = document.getElementById('uppercase-check');
    const numberCheck = document.getElementById('number-check');
    const specialCheck = document.getElementById('special-check');
    
    // Toggle password visibility
    togglePasswordBtn.addEventListener('click', function(e) {
        e.preventDefault();
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
        } else {
            passwordInput.type = 'password';
            eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
        }
    });

    // Toggle confirm password visibility
    togglePasswordConfirmBtn.addEventListener('click', function(e) {
        e.preventDefault();
        if (passwordConfirmInput.type === 'password') {
            passwordConfirmInput.type = 'text';
            eyeIconConfirm.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
        } else {
            passwordConfirmInput.type = 'password';
            eyeIconConfirm.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
        }
    });
    
    function updatePasswordValidation() {
        const password = passwordInput.value;
        
        // Check length (minimum 8 characters)
        if (password.length >= 8) {
            lengthCheck.textContent = '✓';
            lengthCheck.className = 'text-green-500';
        } else {
            lengthCheck.textContent = '○';
            lengthCheck.className = 'text-gray-500';
        }
        
        // Check uppercase (at least 1)
        if (/[A-Z]/.test(password)) {
            uppercaseCheck.textContent = '✓';
            uppercaseCheck.className = 'text-green-500';
        } else {
            uppercaseCheck.textContent = '○';
            uppercaseCheck.className = 'text-gray-500';
        }
        
        // Check number (at least 1)
        if (/[0-9]/.test(password)) {
            numberCheck.textContent = '✓';
            numberCheck.className = 'text-green-500';
        } else {
            numberCheck.textContent = '○';
            numberCheck.className = 'text-gray-500';
        }
        
        // Check special character (at least 1)
        if (/[*_\-!@#$%^&()+=\[\]{};:'",.<>?/\\|`~]/.test(password)) {
            specialCheck.textContent = '✓';
            specialCheck.className = 'text-green-500';
        } else {
            specialCheck.textContent = '○';
            specialCheck.className = 'text-gray-500';
        }
    }
    
    // Update validation on input
    passwordInput.addEventListener('input', updatePasswordValidation);
});
</script>