<x-authentication-layout>



<h1 class="text-3xl text-slate-800 dark:text-slate-100 font-bold mb-6"> ✨ {{ __('Pharmaceuticals') }}</h1>
    <h1 class="text-3xl text-center text-slate-800 dark:text-slate-100 font-bold mb-6">{{ __('Sign In') }}</h1>
   
    <p class="text-slate-600 dark:text-slate-400 mb-6 text-center">{{ __('Login to stay connected') }}</p>
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif   
    <!-- Form -->
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="space-y-4">
        {{-- add center aligned heading --}}
        
            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" type="email" name="email" :value="old('email')" required autofocus placeholder="enter your email" />                
            </div>
            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" type="password" name="password" required autocomplete="current-password"  placeholder="enter your password"/>                
            </div>
        </div>
        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <div class="mr-1">
                    <a class="text-sm underline hover:no-underline" href="{{ route('password.request') }}">
                        {{ __('Forgot Password?') }}
                    </a>
                </div>
            @endif            
            <x-button class="ml-3 text-center d-flex justify-content-center">
                {{ __('Sign in') }}
            </x-button>            
        </div>
    </form>
    <x-validation-errors class="mt-4" />   
   
</x-authentication-layout>