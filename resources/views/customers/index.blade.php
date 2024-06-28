
<x-app-layout>
 
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
 
        @filamentStyles
        @vite('resources/css/app.css')
    </head>
 
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <h1 class="text-lg font-semibold mb-6">Manage Patients</h1>
    @livewire('list-customers')
    </div>
 
        @filamentScripts
        @vite('resources/js/app.js')
</html>

</x-app-layout>