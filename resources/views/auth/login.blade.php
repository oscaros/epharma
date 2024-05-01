<x-authentication-layout>
    <h1 class="text-3xl text-slate-800 dark:text-slate-100 font-bold mb-6"> ✨ {{ __('Pharmaceuticals') }}</h1>
    <h1 class="text-3xl text-center text-slate-800 dark:text-slate-100 font-bold mb-6">{{ __('Sign In') }}</h1>
   
    <p class="text-slate-600 dark:text-slate-400 mb-6 text-center">{{ __('Login ') }}</p>
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif   
    <!-- Tab navigation -->
    <div class="flex justify-center mb-6">
        <button id="email-tab" class="px-4 py-2 rounded-md bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 focus:outline-none mr-4" onclick="switchTab('email')">Email</button>
        <button id="phone-tab" class="px-4 py-2 rounded-md bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 focus:outline-none" onclick="switchTab('phone')">Phone</button>
    </div>
    
    <!-- Email input -->
    <form id="email-input" method="POST" action="{{ route('login') }}">
        @csrf
        <x-label for="email" value="{{ __('Email') }}" />
        <x-input id="email" type="email" name="email" :value="old('email')"  autofocus placeholder="enter your email" />                
        
        <!-- Password input -->
        <x-label for="password" value="{{ __('Password') }}" />
        <x-input id="password" type="password" name="password" required autocomplete="current-password"  placeholder="enter your password"/>                
        
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

    <!-- Phone input -->
    <form id="phone-input" method="POST" action="{{ route('login') }}" style="display: none;">
        @csrf
        <x-label for="phone_number" value="{{ __('Phone Number') }}" />
        <x-input id="phone_number" type="number" name="phone_number" :value="old('phone_number')"  autofocus placeholder="enter your phone number" />                
        
        <!-- Password input -->
        <x-label for="password" value="{{ __('Password') }}" />
        <x-input id="password" type="password" name="password" required autocomplete="current-password"  placeholder="enter your password"/>                
        
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



    <!-- Your Livewire component HTML content goes here -->

    @livewireScripts

    <script>
        function switchTab(tab) {
            if (tab === 'email') {
                document.getElementById('email-tab').classList.add('active');
                document.getElementById('phone-tab').classList.remove('active');
                document.getElementById('email-input').style.display = 'block';
                document.getElementById('phone-input').style.display = 'none';
                //add style
                document.getElementById('phone-tab').style.backgroundColor = 'white';
                document.getElementById('email-tab').style.backgroundColor = 'grey';
            } else {
                document.getElementById('phone-tab').classList.add('active');
                document.getElementById('email-tab').classList.remove('active');
                document.getElementById('phone-input').style.display = 'block';
                document.getElementById('email-input').style.display = 'none';
                //add style
                document.getElementById('email-tab').style.backgroundColor = 'white';
                document.getElementById('phone-tab').style.backgroundColor = 'grey';
            }
        }

        // Initialize with the email tab active
        switchTab('email');
    </script>
