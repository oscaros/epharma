@if (in_array('Departments', json_decode(optional(Auth::user()->role)->permissions, true) ?? []))
<x-app-layout>

    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <h1 class="text-lg font-semibold mb-6">Add Service Point</h1>
        @livewire('create-department', ['filter' => request()->query('filter', 'all')])
    </div>


</x-app-layout>
@else
<h1 class="text-lg font-semibold mb-6">You do not have permission to view this page</h1>
@endif
