@if (in_array('Sales', json_decode(optional(Auth::user()->role)->permissions, true) ?? []))
    <x-app-layout>
        <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
            <h1 class="text-lg font-semibold mb-6">Manage Service Status</h1>
            <div class="flex justify-end my-4">
                <a class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600" href="{{ route('sales.create') }}">Make New Selection</a>
            </div>
            @if(isset($sale))
                <h2 class="text-md font-semibold mb-4">Sale ID: {{ $sale->id }}</h2>
                @livewire('list-sale-items', ['customer_id' => $sale->customer_id, 'sale_id' => $sale->id])
            @else
                <p>No sale found.</p>
            @endif
        </div>
    </x-app-layout>
@else
    <h1 class="text-lg font-semibold mb-6">You do not have permission to view this page</h1>
@endif
