
<x-app-layout>
  
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <h1 class="text-lg font-semibold mb-6">Manage Products</h1>
    @livewire('list-products', ['filter' => request()->query('filter', 'all')])
    </div>

    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <h1 class="text-lg font-semibold mb-6">Manage Sales</h1>
    @livewire('list-sales', ['filter' => request()->query('filter', 'all')])
    </div>
 

</x-app-layout>