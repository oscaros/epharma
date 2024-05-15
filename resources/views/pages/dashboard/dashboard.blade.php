<x-app-layout>
  @if (in_array('Dashboard', json_decode(optional(Auth::user()->role)->permissions, true) ?? []))
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        
        <!-- Welcome banner -->
        <x-dashboard.welcome-banner />
                        <livewire:dashboard />


    </div>
    @else
        {{-- <h1 class="text-lg font-semibold mb-6">You do not have permission to view this page</h1> --}}
        <h1 class="text-lg font-semibold mb-6">Welcome</h1>
    @endif
</x-app-layout>
